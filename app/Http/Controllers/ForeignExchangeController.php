<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ForeignExchangeRepository;

class ForeignExchangeController extends Controller
{
    public function index() {
        return view("index")->with([
        'supportedSymbols' => ForeignExchangeRepository::getSupportedSymbols(),
        'hasErrors' => false
        ]);
    }

    public function convert() {
        return view("index");
    }
}
