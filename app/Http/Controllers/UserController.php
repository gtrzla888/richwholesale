<?php

namespace App\Http\Controllers;


use App\User;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Company as CompanyResource;

class UserController
{
    public function index()
    {
        return new UserResource(request()->user());
    }

    public function companies(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $companies = $user->companies;
        if ($user->hasRole(User::ROLE_WHOLESALE_ADMIN)) {
            $companies = Company::all();
        }
        return CompanyResource::collection($companies);
    }
}
