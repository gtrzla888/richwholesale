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
        $quote->total = 400;
        $quote->save();

        $order = new Order();
        $order->notes = 'test';
        $order->total = 300;
        $order->quote_id = $quote->id;
        $order->product_type = BasswoodShutter::NAME;
        $order->save();

        $shutter = factory(BasswoodShutter::class)->make();
        $shutter->price = 100;
        $shutter->save();
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->order()->associate($order);
        $orderItem->save();

        $shutter = factory(BasswoodShutter::class)->make();
        $shutter->price = 200;
        $shutter->save();
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
       
        $orderItem->order()->associate($order);
        $orderItem->save();

    
        $order = new Order();
        $order->notes = 'test';
        $order->total = 100;
        $order->product_type = PVCShutter::NAME;
        $order->quote_id = $quote->id;
        $order->save();

        $shutter = factory(PVCShutter::class)->make();
        $shutter->price = 100;
        $shutter->save();
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->order()->associate($order);
        $orderItem->save();
    }
}
