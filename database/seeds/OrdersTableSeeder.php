<?php

use Illuminate\Database\Seeder;
use App\OrderItem;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shutter = \App\Shutter::find(1);
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->note = 'test';

        $order = new \App\Order();
        $order->company()->associate(\App\Company::find(1));
        $order->po_reference = uniqid();
        $order->status = 'completed';
        $order->notes = 'test';
        $order->save();

        $orderItem->order()->associate($order);

        $orderItem->save();
    }
}
