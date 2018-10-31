@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-5">
                <div class="card shadow-lg rounded">
                    <h3 class="card-header text-center">
                        <img id="logo"
                             src='{{ asset("images/foreignexchange-logo@2x.png") }}'/>{{ config('APP_NAME', 'Currency Converter') }}
                    </h3>
                    <div class="card-body">
                        <h5 class="card-title">Go ahead, give it a try!</h5>
                        <p class="card-text">
                            Use the currency converter below to convert between different national currencies using the average exchange
                            rate for the selected period.
                        </p>
                        <p class="card-text font-italic text-center text-danger">* Required fields.</p>
                        <form action="/convert" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text justify-content-end"
                                               for="convertFrom">From:<span class='text-danger'>&nbsp;*</span></label>
                                    </div>
                                    <select class="custom-select" id="convertFrom" name="convertFrom" required>
                                        <option value="">--- Select Currency ---</option>
                                        @foreach ($supportedSymbols as $symbol => $name)
                                            <option value="{{ $symbol }}"
                                                @include('modules.selectedoption', [
                                                    'field' => 'convertFrom',
                                                    'value' => $symbol])>
                                                {{ $name }} ({{ $symbol }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text justify-content-end"
                                               for="convertTo">To:<span class='text-danger'>&nbsp;*</span></label>
                                    </div>
                                    <select class="custom-select" id="convertTo" name="convertTo" required>
                                        <option value="">--- Select Currency ---</option>
                                        @foreach ($supportedSymbols as $symbol => $name)
                                            <option value="{{ $symbol }}"
                                                @include('modules.selectedoption', [
                                                    'field' => 'convertTo',
                                                    'value' => $symbol])>
                                                {{ $name }} ({{ $symbol }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text justify-content-end"
                                               for='amountToConvert'>Amount:<span class='text-danger'>&nbsp;*</span></label>
                                    </div>
                                    <input type="number"
                                           class="form-control"
                                           id="amountToConvert"
                                           name="amountToConvert"
                                           min="1"
                                           value="{{ (old('amountToConvert', null) != null) ? old('amountToConvert') : (isset($amountToConvert) ? $amountToConvert : "1.00") }}"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <Label>Average Rate Period:<span class='text-danger'>&nbsp;*</span></label><br/>
                                <div class="btn-group btn-group-toggle justify-content-center" data-toggle="buttons">
                                    <label class="btn btn-secondary">
                                        <input
                                            type="radio"
                                            id="dailyAverage"
                                            name="period"
                                            value="Daily"
                                            required
                                            @include('modules.checkedoption', [
                                                'field' => 'period',
                                                'value' => 'Daily'])> Daily
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input
                                            type="radio"
                                            id="weeklyAverage"
                                            name="period"
                                            required
                                            value="Weekly"
                                            @include('modules.checkedoption', [
                                                'field' => 'period',
                                                'value' => 'Weekly'])> Weekly
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input
                                            type="radio"
                                            id="monthlyAverage"
                                            name="period"
                                            required
                                            value="Monthly"
                                            @include('modules.checkedoption', [
                                               'field' => 'period',
                                              'value' => 'Monthly'])> Monthly
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input
                                            type="radio"
                                            id="sixMonthAverage"
                                            name="period"
                                            required
                                            value="Six Month"
                                            @include('modules.checkedoption', [
                                                'field' => 'period',
                                                'value' => 'Six Month'])> Six Months
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input
                                            type="radio"
                                            id="yearlyAverage"
                                            name="period"
                                            required
                                            value="Yearly"
                                            @include('modules.checkedoption', [
                                            'field' => 'period',
                                            'value' => 'Yearly'])> Yearly
                                    </label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="convert" class="btn btn-outline-primary">Convert</button>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class='alert alert-danger mb-3' role="alert">
                                <h4>Errors</h4>
                                <hr>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif ($convertedAmount > 0)
                            <div class="alert alert-success mb-3" role="alert">
                                <h4>Success!</h4>
                                <hr>
                                <p class="text-center">
                                    Using the
                                    <strong>{{ $period }}</strong> average exchange rate
                                    <strong>{{ $averageConversionRate }}</strong>
                                </p>
                                <p class="text-center">
                                    <strong>{{ $amountToConvert . " " . $convertFrom }}</strong> is equivalent to
                                    <strong>{{ number_format($convertedAmount, 2) }} {{ $convertTo }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
