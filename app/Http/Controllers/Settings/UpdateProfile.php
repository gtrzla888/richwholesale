<?php

namespace App\Http\Controllers\Settings;

use App\BillingAddress;
use App\Company;
use App\DeliveryAddress;
use App\Http\Requests\UpdateProfile as UpdateProfileRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\User;

class UpdateProfile extends Controller
{

    /**
     * Update the user's profile information.
     *
     * @param UpdateProfileRequest $request
     *
     * @return User
     */
    public function __invoke(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();


        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->contact_number = $validated['contact_number'];
        $user->save();
        $company = Company::findOrFail($validated['company']['id']);
        $company->abn = $validated['abn'];
        $company->save();

        unset($validated['company']['billingAddress']['id']);
        if (!$billingAddress = $company->billingAddress) {
            $billingAddress = new BillingAddress();
        }

        $billingAddress->fill($validated['company']['billingAddress']);
        $billingAddress->company_id = $company->id;
        $billingAddress->save();

        unset($validated['company']['deliveryAddress']['id']);
        if (!$deliveryAddress = $company->deliveryAddress) {
            $deliveryAddress = new DeliveryAddress();
        }

        $deliveryAddress->fill($validated['company']['deliveryAddress']);
        $deliveryAddress->company_id = $company->id;
        $deliveryAddress->save();

        return new UserResource($user);
    }
}
