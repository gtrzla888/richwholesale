<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\BulkSubmitQuote;
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
use App\Http\Requests\UpdateQuote;
use App\Http\Resources\Quote as QuoteResource;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        
         /** @var User $user */
         $user = request()->user();

         $query = Quote::with('orders')->with('company')->with('orders.items.product');

        if ($user->hasRole(User::ROLE_WHOLESALE_ADMIN) || $user->hasRole(User::ROLE_WHOLESALE_USER)) {
            $companies = Company::all()->pluck('id');
        } else {
            $companies = $user->companies->pluck('id');
        }

        if ($company = $request->get('company')) {
            $companies = $companies->intersect([$company]);
        }

        $query->whereIn('quotes.company_id', $companies);
 
         if ($createdAt = $request->get('created_at')) {
             $query->where('created_at', '>=', $createdAt);
         }
 
         return $query->get('quotes.*');
    }

    public function store(StoreQuote $request)
    {
        $validated = $request->validated();
        if (isset($validated['id'])) {
            $quote = Quote::find($validated['id']);
        } else {
            $quote = new Quote();
        }

        if ($request->get('order')) {
            $quote->status = Quote::STATUS_ORDERED;
        } else {
            $quote->status = Quote::STATUS_PENDING;
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
            $order->status = $quote->status;
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
            $quote->total += $order->total;
            $order->save();
        }

        if (!empty($validated['pvc_shutters'])) {
            $order = new Order();
            $order->product_type = PVCShutter::NAME;
            $order->total = 0;
            $order->status = $quote->status;
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
            $quote->total += $order->total;
            $order->save();
        }

        if (!empty($validated['au_pvc_shutters'])) {
            $order = new Order();
            $order->product_type = AUPVCShutter::NAME;
            $order->total = 0;
            $order->status = $quote->status;
            $quote->orders()->save($order);
            $order->save();
            foreach ($validated['au_pvc_shutters'] as $shutter) {
                $item = new OrderItem();
                $product = AUPVCShutter::create($shutter);
                $product->price = $product->getPrice();
                $order->total += $product->price;
                $item->product()->associate($product);
                $order->items()->save($item);
            }
            $quote->total += $order->total;
            $order->save();
        }

        if (!empty($validated['aluminium_shutters'])) {
            $order = new Order();
            $order->product_type = AluminiumShutter::NAME;
            $order->total = 0;
            $order->status = $quote->status;
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
            $quote->total += $order->total;
            $order->save();
        }

        if (!empty($validated['roller_blinds'])) {
            $order = new Order();
            $order->product_type = RollerBlind::NAME;
            $order->total = 0;
            $order->status = $quote->status;
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
            $quote->total += $order->total;
            $order->save();
        }

        $quote->save();

        return $quote;
    }

    public function price(Request $request)
    {
        $validated = $request->all();
        $price = 0;
        if (!empty($validated['basswood_shutters'])) {
            foreach ($validated['basswood_shutters'] as $shutter) {
                $product = BasswoodShutter::make($shutter);
                $price += $product->getPrice();
            }
        }

        if (!empty($validated['pvc_shutters'])) {
            foreach ($validated['pvc_shutters'] as $shutter) {
                $product = PVCShutter::make($shutter);
                $price += $product->getPrice();
            }
        }

        if (!empty($validated['au_pvc_shutters'])) {
            foreach ($validated['au_pvc_shutters'] as $shutter) {
                $product = AUPVCShutter::make($shutter);
                $price += $product->getPrice();
            }
        }


        if (!empty($validated['aluminium_shutters'])) {
            foreach ($validated['aluminium_shutters'] as $shutter) {
                $product = AluminiumShutter::make($shutter);
                $price += $product->getPrice();
            }
        }

        if (!empty($validated['roller_blinds'])) {
            foreach ($validated['roller_blinds'] as $shutter) {
                $product = RollerBlind::make($shutter);
                $price += $product->getPrice();
            }
        }

        return $price;
    }

    public function show(Quote $quote)
    {
        return new QuoteResource($quote);
    }

    /**
     * @param Quote       $quote
     * @param UpdateQuote $request
     *
     * @return Quote
     */
    public function update(Quote $quote, UpdateQuote $request)
    {
        $validated = $request->validated();
        if (isset($validated['status'])) {
            $quote->status = $validated['status'];
        }

        if ($quote->status == Quote::STATUS_ORDERED) {
            foreach ($quote->orders as $order) {
                $order->status = Order::STATUS_ORDERED;
                $order->save();
            }
        }

        $quote->save();

        return $quote;
    }

    public function bulkSubmit(BulkSubmitQuote $request)
    {
        $validated = $request->validated();

        $quotes = Quote::whereIn('id', $validated['quote_ids'])->get();

        $quotes->each(function (Quote $quote) {
            $quote->orders->each(function(Order $order) {
                $order->update(['status' => Order::STATUS_ORDERED]);
            });
            
            $quote->update(['status' => Quote::STATUS_ORDERED]);
        });

        return QuoteResource::collection($quotes);
    }

    public function delete(Quote $quote)
    {
        $quote->orders()->delete();
        $quote->delete();

        return response()->json();
    }
}
