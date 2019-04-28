<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Quote;
use App\CustomerQuote;
use Illuminate\Http\Request;

class CustomerQuoteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Quote $quote, Request $request)
    {
        $customerQuote = new CustomerQuote();
        $customerQuote->quote_id = $quote->id;
        $customerQuote->fixed_markup = $request->get('fixed_markup');
        $customerQuote->percentage_markup = $request->get('percentage_markup');
        $customerQuote->save();

    }
}
