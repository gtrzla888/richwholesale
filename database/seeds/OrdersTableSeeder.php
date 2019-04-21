<?php

use Illuminate\Database\Seeder;
use App\OrderItem;
use App\BasswoodShutter;
use App\Order;
use App\Company;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shutter = BasswoodShutter::find(1);
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->price = 100;
        $orderItem->note = 'test';

        $order = new Order();
        $order->company()->associate(Company::find(1));
        $order->po_reference = uniqid();
        $order->status = 'Confirmed';
        $order->notes = 'test';
        $order->total = 200;
        $order->save();

        $orderItem->order()->associate($order);

        $orderItem->save();
    }
}
