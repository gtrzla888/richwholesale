<?php

namespace App\Http\Controllers;

use App\Order;
use App\Invoice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Invoice as InvoiceResource;

class InvoiceController extends Controller
{
    public function index()
    {
        return InvoiceResource::collection(Invoice::all());
    }
}
