@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-5">
                <div class="card">
                    <h3 class="card-header text-center"><img id="logo" src='{{ asset("images/foreignexchange-logo@2x.png") }}' />{{ config('APP_NAME', 'Currency Converter') }}</h3>
                    <div class="card-body">
                        <h5 class="card-title">Go ahead, give it a try!</h5>
                        <p class="card-text">
                            Use the currency converter below to convert between different national currencies using the average exchange
                            rate for the selected period.
                        </p>
                        <p class="card-text font-italic text-center text-danger">* Required fields.</p>
                        <form action="/convert" method="POST">
                            <div class="form-group">
                                <label for="convertFrom">From:<span class='text-danger'>&nbsp;*</span></label>
                                <select class="form-control" id="convertFrom" name="convertFrom" required>
                                    <option value=""> --- Select Currency ---</option>
                                    <?php foreach ($supportedSymbols as $symbol => $name) : ?>
                                    <option value="<?= $symbol ?>" <?= (isset($convertFrom) && ($convertFrom == $symbol)) ? " selected" : "" ?>><?= $name ?> (<?= $symbol ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="convertTo">To:<span class='text-danger'>&nbsp;*</span></label>
                                <select class="form-control" id="convertTo" name="convertTo" required>
                                    <option value=""> --- Select Currency ---</option>
                                    <?php foreach ($supportedSymbols as $symbol => $name) : ?>
                                    <option value="<?= $symbol ?>"<?= (isset($convertTo) && ($convertTo == $symbol)) ? " selected" : "" ?>><?= $name ?> (<?= $symbol ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amountToConvert">Amount:<span class='text-danger'>&nbsp;*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number"
                                           class="form-control"
                                           id="amountToConvert"
                                           name="amountToConvert"
                                           min="1"
                                           value="<?= isset($amountToConvert) ? sanitize($amountToConvert) : "1.00" ?>"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <Label>Average Rate Period:<span class='text-danger'>&nbsp;*</span></label><br/>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="dailyAverage"
                                           name="period"
                                           value="Daily"
                                           required
                                    <?= (isset($period) && (strtoupper($period) == 'DAILY')) ? " checked" : "" ?>>
                                    <label class="form-check-label" for="dailyAverage">Daily</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="weeklyAverage"
                                           name="period"
                                           required
                                           value="Weekly" <?= (isset($period) && (strtoupper($period) == 'WEEKLY')) ? " checked" : "" ?>>
                                    <label class="form-check-label" for="weeklyAverage">Weekly</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="monthlyAverage"
                                           name="period"
                                           required
                                           value="Monthly" <?= (isset($period) && (strtoupper($period) == 'MONTHLY')) ? " checked" : "" ?>>
                                    <label class="form-check-label" for="monthlyAverage">Monthly</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="sixMonthAverage"
                                           name="period"
                                           required
                                           value="Six Month" <?= (isset($period) && (strtoupper($period) == 'SIX MONTH')) ? " checked" : "" ?>>
                                    <label class="form-check-label" for="sixMonthAverage">Six Months</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                           type="radio"
                                           id="yearlyAverage"
                                           name="period"
                                           required
                                           value="Yearly" <?= (isset($period) && (strtoupper($period) == 'YEARLY')) ? " checked" : "" ?>>
                                    <label class="form-check-label" for="yearlyAverage">Yearly</label>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="convert" class="btn btn-outline-primary">Convert</button>
                            </div>
                        </form>
                        <?php if ($hasErrors): ?>
                        <div class='alert alert-danger mb-3' role="alert">
                            <h4>Errors</h4>
                            <hr>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif ?>
                        <?php if (isset($results) && !$hasErrors): ?>
                        <div class="alert alert-success mb-3" role="alert">
                            <h4>Success!</h4>
                            <hr>
                            <p class="text-center">
                                Using the
                                <strong><?= $period ?></strong> average exchange rate
                                <strong><?= $results["averageConversionRate"] ?></strong>
                            </p>
                            <p class="text-center">
                                <strong><?= $amountToConvert . " " . $convertFrom ?></strong> is equivalent to
                                <strong><?= number_format($results["convertedAmount"], 2) ?> <?= $convertTo ?></strong>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
