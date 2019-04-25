<?php

namespace App\Http\Controllers;

use App\AluminiumShutter;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\Http\Requests\StoreQuote;
use App\Order;
use App\OrderItem;
use App\PVCShutter;
use App\Quote;
use App\RollerBlind;
use App\User;
use Illuminate\Http\Request;

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

        $quote = new Quote();
        $quote->company_id = $validated['company_id'];
        $quote->po_reference = $validated['po_reference'];
        if (isset($validated['customer_name'])) {
            $quote->customer_name = $validated['customer_name'];
        }
        $quote->notes = $validated['notes'];
        $quote->total = 0;
        $quote->save();
        if (isset($validated['basswood_shutters'])) {
            $order = new Order();
            foreach ($validated['basswood_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = BasswoodShutter::create($shutter);
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
            $order->save();
            $quote->orders()->save($order);
        }

        if (!empty($validated['pvc_shutters'])) {
            $order = new Order();
            foreach ($validated['pvc_shutters'] as $shutter) {

                $item = new OrderItem();
                $product = PVCShutter::create($shutter);
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
            $order->save();
            $quote->orders()->save($order);
        }

        if (!empty($validated['au_pvc_shutters'])) {
            $order = new Order();
            foreach ($validated['au_pvc_shutters'] as $shutter) {
                $order = new Order();
                $item = new OrderItem();
                $product = AUPVCShutter::create($shutter);
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
            $order->save();
            $quote->orders()->save($order);
        }

        if (!empty($validated['aluminium_shutters'])) {
            $order = new Order();
            foreach ($validated['aluminium_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = AluminiumShutter::create($shutter);
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($shutter['notes'])) {
                    $item->notes = $shutter['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);
            }
            $order->save();
            $quote->orders()->save($order);
        }

        if (!empty($validated['roller_blinds'])) {
            $order = new Order();
            foreach ($validated['roller_blinds'] as $rollerBlind) {
                $item = new OrderItem();
                $product = RollerBlind::create($rollerBlind);
                $item->price = $product->getPrice();
                $order->total += $item->price;
                if (isset($rollerBlind['notes'])) {
                    $item->notes = $rollerBlind['notes'];
                }
                $item->product()->associate($product);
                $order->items()->save($item);

            }
            $order->save();
            $quote->orders()->save($order);
        }

        $quote->save();

        return $quote;
    }

    public function price()
    {

    }

    public function getTotalPriceAttribute()
    {
        
    }

}
