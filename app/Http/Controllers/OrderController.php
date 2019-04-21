<?php

namespace App\Http\Controllers;

use App\AluminiumShutter;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\Http\Requests\StoreOrder;
use App\Order;
use App\OrderItem;
use App\PVCShutter;
use App\RollerBlind;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        /** @var User $user */
        $user = request()->user();

        return Order::with('company')->with('items.product')->get();
    }

    public function store(StoreOrder $request)
    {
        $validated = $request->validated();

        $order = new Order();
        $order->company_id = $validated['company_id'];
        $order->po_reference = $validated['po_reference'];
        $order->customer_name = $validated['customer_name'];
        $order->note = $validated['note'];
        foreach ($validated['basswood_shutters'] as $shutter) {
            $product = BasswoodShutter::create($shutter);
            $item = new OrderItem();
            $item->price = $product->getPrice();
            $item->note = $shutter['note'];
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        foreach ($validated['pvc_shutters'] as $shutter) {
            $product = PVCShutter::create($shutter);
            $item = new OrderItem();
            $item->price = $product->getPrice();
            $item->note = $shutter['note'];
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        foreach ($validated['au_pvc_shutters'] as $shutter) {
            $product = AUPVCShutter::create($shutter);
            $item = new OrderItem();
            $item->price = $product->getPrice();
            $item->note = $shutter['note'];
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        foreach ($validated['aluminium_shutters'] as $shutter) {
            $product = AluminiumShutter::create($shutter);
            $item = new OrderItem();
            $item->price = $product->getPrice();
            $item->note = $shutter['note'];
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        foreach ($validated['roller_blinds'] as $rollerBlind) {
            $product = RollerBlind::create($rollerBlind);
            $item = new OrderItem();
            $item->price = $product->getPrice();
            $item->note = $rollerBlind['note'];
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        $order->save();

        return $order;
    }


    /**
     * @param Order $order
     */
    public function update(Order $order, Request $request)
    {

    }

}
