<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ForeignExchangeRepository;

class ForeignExchangeController extends Controller
{
    public function index(Request $request)
    {
        $session = $request->session();

        return view("index")->with([
            'supportedSymbols' => ForeignExchangeRepository::getSupportedSymbols(),
            'convertFrom' => $session->get('convertFrom'),
            'convertTo' => $session->get('convertTo'),
            'amountToConvert' => $session->get('amountToConvert'),
            'period' => $session->get('period'),
            'convertedAmount' => $session->get('convertedAmount', 0),
            'averageConversionRate' => $session->get('averageConversionRate', 0)
        ]);
    }

    public function convert(Request $request)
    {
        # Get FORM input if it exists.
        $convertFrom = $request->get('convertFrom');
        $convertTo = $request->get('convertTo');
        $amountToConvert = $request->get('amountToConvert');
        $period = $request->get('period');

        # Only calculate converted amount if form is submitted and valid.
        $request->validate([
            'convertFrom' => 'required',
            'convertTo' => 'required',
            'amountToConvert' => 'required|numeric|min:1',
            'period' => 'required'
        ]);

        # connect to Fixer API endpoint.
        $fixer = new ForeignExchangeRepository($convertFrom, $convertTo, $period, $amountToConvert);

        # calculate converted amount and retrieve conversion rates
        $convertedAmount = $fixer->convert();
        $averageConversionRate = $fixer->getAverageConversionRate();

        return redirect('/')->with([
            'convertFrom' => $convertFrom,
            'convertTo' => $convertTo,
            'amountToConvert' => $amountToConvert,
            'period' => $period,
            'convertedAmount' => $convertedAmount,
            'averageConversionRate' => $averageConversionRate
        ]);
    }
}
