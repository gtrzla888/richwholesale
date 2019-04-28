<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Quote;
use App\OrderItem;
use App\PVCShutter;
use App\RollerBlind;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\AluminiumShutter;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuote;
use App\Http\Resources\Quote as QuoteResource;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
         /** @var User $user */
         $user = request()->user();

         $query = Quote::with('orders')->with('company')->with('orders.items.product');
 
         if ($company = $request->get('company')) {
             $query->where('company_id', $company);
         }
 
         if ($createdAt = $request->get('created_at')) {
             $query->where('created_at', '>=', $createdAt);
         }
 
         return $query->get();
    }

    public function store(StoreQuote $request)
    {
        $validated = $request->validated();
        if (isset($validated['id'])) {
            $quote = Quote::find($validated['id']);
        } else {
            $quote = new Quote();
        }
        $quote->company_id = $validated['company_id'];
        $quote->po_reference = $validated['po_reference'];
        $quote->customer_name = $validated['customer_name'];
        $quote->notes = $validated['notes'];
        $quote->total = 0;
        $quote->save();
        if (isset($validated['basswood_shutters'])) {
            $order = new Order();
            $order->product_type = BasswoodShutter::NAME;
            $order->total = 0;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['basswood_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = BasswoodShutter::create($shutter);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (!empty($validated['pvc_shutters'])) {
            $order = new Order();
            $order->product_type = PVCShutter::NAME;
            $order->total = 0;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['pvc_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = PVCShutter::create($shutter);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (!empty($validated['au_pvc_shutters'])) {
            $order = new Order();
            $order->product_type = AUPVCShutter::NAME;
            $order->total = 0;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['au_pvc_shutters'] as $shutter) {
                $order = new Order();
                $item = new OrderItem();
                $product = AUPVCShutter::create($shutter);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (!empty($validated['aluminium_shutters'])) {
            $order = new Order();
            $order->product_type = AluminiumShutter::NAME;
            $order->total = 0;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['aluminium_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = AluminiumShutter::create($shutter);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        if (!empty($validated['roller_blinds'])) {
            $order = new Order();
            $order->product_type = RollerBlind::NAME;
            $order->total = 0;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['roller_blinds'] as $rollerBlind) {
                $item = new OrderItem();
                $product = RollerBlind::create($rollerBlind);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
        }

        $quote->save();

        return $quote;
    }

    public function price()
    {

    }

    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    public function getTotalPriceAttribute()
    {
        
    }

}
