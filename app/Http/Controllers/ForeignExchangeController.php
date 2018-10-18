<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForeignExchangeController extends Controller
{
    public function index() {
        return "main foreign exchange view";
    }

    public function convert() {
        return "conversion process and redirect to main";
    }

}
