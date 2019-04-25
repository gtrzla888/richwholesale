<?php

use Illuminate\Database\Seeder;
use App\OrderItem;
use App\BasswoodShutter;
use App\PVCShutter;
use App\Order;
use App\Company;
use App\Quote;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quote = new Quote();
        $quote->status = 'Pending';
        $quote->company()->associate(Company::find(2));
        $quote->customer_name = 'Richard Thompson';
        $quote->po_reference = uniqid();
        $quote->status = 'Pending';
        $quote->save();

        $shutter = BasswoodShutter::find(1);
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->price = 100;
        $orderItem->notes = 'test';

        $order = new Order();
        $order->notes = 'test';
        $order->total = 100;
        $order->quote_id = $quote->id;
        $order->save();
        $orderItem->order()->associate($order);
        $orderItem->save();

        $shutter = PVCShutter::find(1);
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->price = 100;
        $orderItem->notes = 'test';

        $order = new Order();
        $order->notes = 'test';
        $order->total = 100;
        $order->quote_id = $quote->id;
        $order->save();

        $orderItem->order()->associate($order);

        $orderItem->save();
    }
}
