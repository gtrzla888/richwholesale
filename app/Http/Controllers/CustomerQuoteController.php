<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Order;
use App\Quote;
use App\CustomerQuote;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerQuote;
use App\Http\Requests\UpdateCustomerQuote;

class CustomerQuoteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = CustomerQuote::join('quotes', 'customer_quotes.id', '=', 'quotes.id')->with('quote.orders.items.product')->with('quote.company');

        if ($user->hasRole(User::ROLE_WHOLESALE_ADMIN) || $user->hasRole(User::ROLE_WHOLESALE_USER)) {
            $companies = Company::all()->pluck('id');
        } else {
            $companies = $user->companies->pluck('id');
        }

        if ($company = $request->get('company')) {
            $companies = $companies->intersect([$company]);
        }

        $query->whereIn('quotes.company_id', $companies);

        if ($createdAt = $request->get('created_at')) {
            $query->where('created_at', '>=', $createdAt);
        }

        return $query->get('customer_quotes.*');
    }

    public function store(Quote $quote, StoreCustomerQuote $request)
    {
        $customerQuote = new CustomerQuote();
        $customerQuote->quote_id = $quote->id;
        $customerQuote->markup_type = $request->get('markup_type');
        $customerQuote->markup_value = $request->get('markup_value');
        $customerQuote->save();
    }

    public function update(CustomerQuote $customerQuote, UpdateCustomerQuote $request)
    {
        $validated = $request->validated();
        if (isset($validated['markup_type'])) {
            $customerQuote->markup_type = $validated['markup_type'];
        }

        if (isset($validated['markup_value'])) {
            $customerQuote->markup_value = $validated['markup_value'];
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
