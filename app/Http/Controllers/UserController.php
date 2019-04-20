<?php

namespace App\Http\Controllers;


use App\Http\Resources\Company as CompanyResource;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return new UserResource(request()->user()->with('companies')->first());
    }

    public function companies(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        return CompanyResource::collection($user->companies);
    }
}
