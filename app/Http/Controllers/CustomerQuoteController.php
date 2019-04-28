<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCustomerQuote;
use App\User;
use App\Order;
use App\Quote;
use App\CustomerQuote;
use Illuminate\Http\Request;

class CustomerQuoteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = CustomerQuote::join('quotes', 'customer_quotes.id', '=', 'quotes.id')->with('quote.orders.items.product')->with('quote.company');

        if ($company = $request->get('company')) {
            $query->where('quotes.company_id', $company);
        } else {
            $query->whereIn('quotes.company_id', $user->companies->pluck('id'));
        }

        if ($createdAt = $request->get('created_at')) {
            $query->where('created_at', '>=', $createdAt);
        }

        return $query->get();
    }

    public function store(Quote $quote, Request $request)
    {
        $customerQuote = new CustomerQuote();
        $customerQuote->quote_id = $quote->id;
        $customerQuote->fixed_markup = $request->get('fixed_markup');
        $customerQuote->percentage_markup = $request->get('percentage_markup');
        $customerQuote->save();

    }

    public function update(CustomerQuote $customerQuote, UpdateCustomerQuote $request)
    {
        $validated = $request->validated();
        if (isset($validated['fixed_markup'])) {
            $customerQuote->fixed_markup = $validated['fixed_markup'];
        }

        if (isset($validated['percentage_markup'])) {
            $customerQuote->percentage_markup = $validated['percentage_markup'];
        }

        $customerQuote->save();

        return $customerQuote;
    }

    public function delete(CustomerQuote $customerQuote)
    {
        $customerQuote->delete();
        return response()->json([]);
    }
}
