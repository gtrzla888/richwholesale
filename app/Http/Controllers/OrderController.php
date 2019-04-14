<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        /** @var User $user */
        $user = request()->user();

        return response()->json($user->orders);
    }
}
