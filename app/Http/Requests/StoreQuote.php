<?php

namespace App\Http\Requests;

use App\AluminiumShutter;
use App\AUPVCShutter;
use App\BasswoodShutter;
use App\PVCShutter;
use App\RollerBlind;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuote extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'company_id' => 'required',
            'po_reference' => 'required',
            'customer_name' => 'max:255',
            'notes' => 'max:255'
        ];

        if (!empty($this->request->get('basswood_shutters'))) {
            foreach(BasswoodShutter::rules() as $key => $rule)
            {
                $rules[sprintf('basswood_shutters.*.%s', $key)] = $rule;
            }
        }

        if (!empty($this->request->get('pvc_shutters'))) {
            foreach(PVCShutter::rules() as $key => $rule)
            {
                $rules[sprintf('pvc_shutters.*.%s', $key)] = $rule;
            }
        }

        if (!empty($this->request->get('au_pvc_shutters'))) {
            foreach(AUPVCShutter::rules() as $key => $rule)
            {
                $rules[sprintf('au_pvc_shutters.*.%s', $key)] = $rule;
            }
        }

        if (!empty($this->request->get('aluminium_shutters'))) {
            foreach(AluminiumShutter::rules() as $key => $rule)
            {
                $rules[sprintf('aluminium_shutters.*.%s', $key)] = $rule;
            }
        }

        if (!empty($this->request->get('roller_blinds'))) {
            foreach(RollerBlind::rules() as $key => $rule)
            {
                $rules[sprintf('roller_blinds.*.%s', $key)] = $rule;
            }
        }

        return $rules;
    }
}
