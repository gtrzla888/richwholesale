<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Order;
use App\OrderItem;
use App\RollerBlind;
use App\Shutter;
use App\User;

class OrderController extends Controller
{

    public function index()
    {
        /** @var User $user */
        $user = request()->user();

        return response()->json($user->orders);
    }

    public function store(StoreOrder $request)
    {
        $validated = $request->validated();

        $order = new Order();
        $order->company_id = $validated['company_id'];
        $order->po_reference = $validated['po_reference'];
        $order->customer_name = $validated['customer_name'];
        foreach ($validated['shutters'] as $shutter) {
            $product = Shutter::create($shutter);
            $item = new OrderItem();
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        foreach ($validated['rollerBlinds'] as $rollerBlinds) {
            $product = RollerBlind::create($rollerBlinds);
            $item = new OrderItem();
            $item->product()->associate($product);
            $order->items()->save($item);
        }

        $order->save();

        return $order;
    }

}
