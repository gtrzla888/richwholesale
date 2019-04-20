<?php


namespace App\Http\Controllers;


use App\Service\ShutterPrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @param Request $request
     *
     * @return float|int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function cost(Request $request)
    {
        try {
            $this->validate($request, $this->rules());
            $priceCalculator = new ShutterPrice($request->only(array_keys($this->rules())));

        } catch (\ErrorException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        return $priceCalculator->getCost();
    }

    protected function rules()
    {
        return [
            'product' => 'required',
            'width' => 'required',
            'drop' => 'required',
            'shutter_type' => 'required_unless:product,roller_blind',
            'corner' => 'required_unless:product,roller_blind',
            'color' => 'required_unless:product,roller_blind',
            'frame' => 'required_unless:product,roller_blind',
            'type' => 'required_if:product,roller_blind',
            'fabric' => 'required_if:product,roller_blind',
            'motor_type' => 'required_if:product,roller_blind',
            'charger' => 'required_if:product,roller_blind',
            'wifi_hub' => 'required_if:product,roller_blind',
            'remote' => 'required_if:product,roller_blind',
            'bracket_options' => 'required_if:product,roller_blind',
        ];
    }
}