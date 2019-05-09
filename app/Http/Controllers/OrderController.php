<?php

namespace App\Http\Controllers;

use App\AluminiumShutter;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\Http\Requests\StoreQuote;
use App\Order;
use App\OrderItem;
use App\PVCShutter;
use App\RollerBlind;
use App\User;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateOrder;
use App\Invoice;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        /** @var User $user */
        $user = request()->user();

        $query = Order::join('quotes', 'orders.quote_id', '=', 'quotes.id')->with('quote.company')->with('items.product')->whereIn('orders.status', [
                Order::STATUS_ORDERED, Order::STATUS_CONFIRMED, 
                Order::STATUS_MANUFACTURING, Order::STATUS_COMPLETED
                ]);

        if ($company = $request->get('company')) {
            $query->where('quotes.company_id', $company);
        }

        if ($createdAt = $request->get('created_at')) {
            $query->where('orders.created_at', '>=', $createdAt);
        }

        return $query->get('orders.*');
    }

    public function store(StoreQuote $request)
    {
        $validated = $request->validated();

        $order = new Order();
        $order->company_id = $validated['company_id'];
        $order->po_reference = $validated['po_reference'];
        if (isset($validated['customer_name'])) {
            $order->customer_name = $validated['customer_name'];
        }
        $order->notes = $validated['notes'];
        $order->total = 0;
        $order->save();
        if (isset($validated['basswood_shutters'])) {
            foreach ($validated['basswood_shutters'] as $shutter) {
                $product = BasswoodShutter::create($shutter);
                $item = new OrderItem();
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (isset($validated['pvc_shutters'])) {
            foreach ($validated['pvc_shutters'] as $shutter) {
                $product = PVCShutter::create($shutter);
                $item = new OrderItem();
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (isset($validated['au_pvc_shutters'])) {
            foreach ($validated['au_pvc_shutters'] as $shutter) {
                $product = AUPVCShutter::create($shutter);
                $item = new OrderItem();
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (isset($validated['aluminium_shutters'])) {
            foreach ($validated['aluminium_shutters'] as $shutter) {
                $product = AluminiumShutter::create($shutter);
                $item = new OrderItem();
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (isset($validated['roller_blinds'])) {
            foreach ($validated['roller_blinds'] as $rollerBlind) {
                $product = RollerBlind::create($rollerBlind);
                $item = new OrderItem();
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($rollerBlind['notes'])) {
                    $item->notes = $rollerBlind['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }


        $order->save();

        return $order;
    }


    /**
     * @param Order       $order
     * @param UpdateOrder $request
     *
     * @return Order
     */
    public function update(Order $order, UpdateOrder $request)
    {
        $validated = $request->validated();
        if (isset($validated['status'])) {
            $order->status = $validated['status'];
        }

        if (isset($validated['eta'])) {
            $order->eta = $validated['eta'];
        }

        if ($order->status === Order::STATUS_COMPLETED && !$order->invoice->id) {
            $invoice = new Invoice();
            $invoice->order_id = $order->id;
            $invoice->status = Invoice::STATUS_INVOICED;
            $invoice->save();
        }

        $order->save();

        return $order;
    }

    public function show(Order $order, Request $request)
    {
        $pdf = PDF::loadView('pdf.order',  compact('order'));

        if ($request->get('format') == 'pdf') {
            return $pdf->download('order.pdf');
        }

        return view('pdf.order', compact('order'));
    }

}
