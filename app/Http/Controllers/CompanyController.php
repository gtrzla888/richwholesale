<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Company as CompanyResource;

class CompanyController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }
}
