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

class OrderController extends Controller
{

    public function index(Request $request)
    {
        /** @var User $user */
        $user = request()->user();

        $query = Order::with('quote.company')->with('items.product');

        if ($company = $request->get('company')) {
            $query->where('quote.company_id', $company);
        }

        if ($createdAt = $request->get('created_at')) {
            $query->where('quote.created_at', '>=', $createdAt);
        }

        return $query->get();
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

        $order->save();

        return $order;
    }

    public function show(Order $order, Request $request)
    {
        $pdf = PDF::loadView('pdf.order',  compact('order'));

        if ($request->expectsJson()) {
            if ($request->get('format') == 'pdf') {

            }

        }

        if ($request->get('format') == 'pdf') {
            $pdf->save(storage_path('app/public/order.pdf'));
            return $pdf->download('order.pdf');
        }

        return view('pdf.order', compact('order'));
    }

}
