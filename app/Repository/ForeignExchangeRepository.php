<?php
/**
 * This class will service as an interface to the FixerIO API,
 * which provides access to foreign exchange rates.
 * https://fixer.io
 */

namespace App\Repository;

use GuzzleHttp\Client;

class ForeignExchangeRepository
{
    /*
     * CONSTANTS
     */
    private const FIXER_API_BASE_URL = 'http://data.fixer.io/api/';
    private const FIXER_API_TIMESERIES_ENPOINT_URL = 'timeseries';
    private const FIXER_API_LATEST_ENPOINT_URL = 'latest';
    private const FIXER_API_SYMBOLS_ENPOINT_URL = 'symbols';
    private const FIXER_API_ACCESS_KEY = '27108040923da4cd86416d7924e9a908';

    /*
     * PROPERTIES
     */
    private $fromCurrency;
    private $toCurrency;
    private $period;
    private $amountToConvert;
    private $averageConversionRate;
    private $client;

    /*
     * ++++++++++++++++++ MAGIC METHODS ++++++++++++++++++++++++
     */

    /**
     * FixerAPI constructor.
     * @param $fromCurrency
     * @param $toCurrency
     * @param $period
     * @param $amountToConvert
     */
    public function __construct($fromCurrency, $toCurrency, $period, $amountToConvert)
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->period = strtoupper($period);
        $this->amountToConvert = $amountToConvert;
        $this->averageConversionRate = 0;

        $this->client = new Client(['base_uri' => ForeignExchangeRepository::FIXER_API_BASE_URL]);
    }

    /*
     * ++++++++++++++++ PUBLIC METHODS START HERE ++++++++++++++++++++++
     */

    /**
     * Gets the currency code for the currency being converted FROM.
     * @return string
     */
    public function getCurrencyFrom()
    {
        return $this->fromCurrency;
    }

    /**
     * Gets the currency code for the currency being converted TO.
     * @return string
     */
    public function getCurrencyTo()
    {
        return $this->toCurrency;
    }

    /**
     * Gets the average rate period.
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Gets the converted amount.
     * @return float
     */
    public function getCovertedAmount()
    {
        return $this->amountToConvert;
    }

    /**
     * Get the calculated average exchange rate.
     * @return int
     */
    public function getAverageConversionRate()
    {
        return $this->averageConversionRate;
    }

    /**
     * Converts the given amount using average rate for the given period.
     * @return float
     */
    public function convert()
    {
        $results = $this->getForeignExchangeRates();

        $sum = 0;
        foreach ($results['rates'] as $value) {
            $sum += $value[$this->toCurrency];
        }

        $this->averageConversionRate = $sum / count($results['rates']);

        $convertedAmount = $this->averageConversionRate * $this->amountToConvert;

        return $convertedAmount;
    }

    /*
     * +++++++++++++++ PRIVATE METHODS STARTS HERE +++++++++++++++++++
     */

    /**
     * Get Foreign Exchanges rates for a given period.
     * @return array
     */
    private function getForeignExchangeRates()
    {
        $url = $this->buildTimeSeriesEndpointURL();

        // Execute request
        $response = $this->client->get($this->buildTimeSeriesEndpointURL());

        // get the result and parse to JSON
        return json_decode($response->getBody(), true);
    }

    /**
     * Returns the timeseries endpoint url based on the given period.
     * @return string
     */
    private function buildTimeSeriesEndpointURL()
    {
        $endPoint = ForeignExchangeRepository::FIXER_API_TIMESERIES_ENPOINT_URL;

        $startDate = new \DateTime();

        $query = [
            'access_key' => ForeignExchangeRepository::FIXER_API_ACCESS_KEY,
            'base' => $this->fromCurrency,
            'symbols' => $this->toCurrency,
            'end_date' => (new \DateTime())->format('Y-m-d')
        ];

        if (strcmp($this->period, 'WEEKLY') == 0) {
            $startDate->sub(new \DateInterval('P1W'));
        } else if (strcmp($this->period, 'MONTHLY') == 0) {
            $startDate->sub(new \DateInterval('P1M'));
        } else if (strcmp($this->period, 'SIX MONTHS') == 0) {
            $startDate->sub(new \DateInterval('P6M'));
        } else if (strcmp($this->period, 'YEARLY') == 0) {
            $startDate->sub(new \DateInterval('P1Y'));
        } else {
            //DAILY IS DEFAULT. NOTHING TO DO.
        }

        $query['start_date'] = $startDate->format('Y-m-d');

        return $endPoint . '?' . http_build_query($query);
    }

    /*
     * +++++++++++++ STATIC METHODS STARTS HERE ++++++++++++++++++
     */

    /**
     * Gets all supported currencies
     * @return array
     */
    public static function getSupportedSymbols()
    {
        // Create new Guzzle client
        $client = new Client(['base_uri' => ForeignExchangeRepository::FIXER_API_BASE_URL]);

        // Build endpoint URL
        $endPoint = ForeignExchangeRepository::FIXER_API_SYMBOLS_ENPOINT_URL;

        $query = [
            'access_key' => ForeignExchangeRepository::FIXER_API_ACCESS_KEY
        ];

        $endPoint .= ('?' . http_build_query($query));

        // Execute request
        $result = $client->get($endPoint);

        // get the result and parse to JSON
        $result_arr = json_decode($result->getBody(), true);

        return (isset($result_arr) && ($result_arr['success'] == 'true')) ? $result_arr["symbols"] : [];
    }
}
