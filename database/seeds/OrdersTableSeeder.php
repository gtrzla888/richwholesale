<?php

use App\Order;
use App\Quote;
use App\Company;
use App\Invoice;
use App\OrderItem;
use App\PVCShutter;
use App\BasswoodShutter;
use Illuminate\Database\Seeder;

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
        $quote->status = Quote::STATUS_ORDERED;
        $quote->company()->associate(Company::find(2));
        $quote->customer_name = 'Richard Thompson';
        $quote->po_reference = uniqid();
        $quote->total = 400;
        $quote->save();

        $order = new Order();
        $order->notes = 'test';
        $order->total = 300;
        $order->quote_id = $quote->id;
        $order->status = Order::STATUS_CONFIRMED;
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
        $order->status = Order::STATUS_MANUFACTURING;
        $order->save();

        $shutter = factory(PVCShutter::class)->make();
        $shutter->price = 100;
        $shutter->save();
        $orderItem = new OrderItem();
        $orderItem->product_type = get_class($shutter);
        $orderItem->product_id = $shutter->id;
        $orderItem->order()->associate($order);
        $orderItem->save();


        $invoice = new Invoice();
        $invoice->order_id = $order->id;
        $invoice->status = Invoice::STATUS_INVOICED;
        $invoice->save();
    }
}
