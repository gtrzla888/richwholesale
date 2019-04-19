<?php

namespace App\Http\Controllers;


use App\Http\Resources\Company as CompanyResource;
use App\User;
use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return request()->user();
    }

    public function companies(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        return CompanyResource::collection($user->companies);
    }
}
