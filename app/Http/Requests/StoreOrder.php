<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'customer_name' => 'required',
        ];

        foreach($this->request->get('bassword_shutters', []) as $key => $shutter)
        {
            foreach ($shutter as $attr => $value) {
                $rules[sprintf('bassword_shutters.%s.%s', $key, $attr)] = 'required';
            }
        }

        foreach($this->request->get('pvc_shutters', []) as $key => $shutter)
        {
            foreach ($shutter as $attr => $value) {
                $rules[sprintf('pvc_shutters.%s.%s', $key, $attr)] = 'required';
            }
        }

        foreach($this->request->get('au_pvc_shutters', []) as $key => $shutter)
        {
            foreach ($shutter as $attr => $value) {
                $rules[sprintf('au_pvc_shutters.%s.%s', $key, $attr)] = 'required';
            }
        }

        foreach($this->request->get('aluminium_shutters', []) as $key => $shutter)
        {
            foreach ($shutter as $attr => $value) {
                $rules[sprintf('aluminium_shutters.%s.%s', $key, $attr)] = 'required';
            }
        }

        foreach($this->request->get('rollerBlinds', []) as $key => $rollerBlind)
        {
            foreach ($rollerBlind as $attr => $value) {
                $rules[sprintf('rollerBlinds.%s.%s', $key, $attr)] = 'required';
            }
        }

        return $rules;
    }
}
