<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\UpdateInvoice;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = request()->user();

        $query = Invoice::join('orders', 'orders.id', '=', 'invoices.order_id')
                        ->join('quotes', 'orders.quote_id', '=', 'quotes.id')->with('order.quote.company');

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

        return $query->get('invoices.*');
    }

    public function update(UpdateInvoice $request, Invoice $invoice)
    {
        $validated = $request->validated();
        if (isset($validated['status'])) {
            $invoice->status = $validated['status'];
        }

        $invoice->save();

        return $invoice;
    }
}
