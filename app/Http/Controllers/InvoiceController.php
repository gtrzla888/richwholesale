<?php

namespace App\Http\Controllers;

use App\Order;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Invoice as InvoiceResource;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = request()->user();

        $query = Invoice::join('orders', 'orders.id', '=', 'invoices.order_id')
                        ->join('quotes', 'orders.quotes_id', '=' . 'quotes.id')->with('order.quote.company');

        if ($company = $request->get('company')) {
            $query->where('quotes.company_id', $company);
        }

        if ($createdAt = $request->get('created_at')) {
            $query->where('created_at', '>=', $createdAt);
        }

        return $query->get('invoices.*');
    }

    public function store(Request $request, Order $order)
    {
        $invoice = new Invoice();
        $invoice->order_id = $order->id;
        $invoice->save();

    }

    public function update(Request $request, Invoice $invoice) 
    {

    }
}
