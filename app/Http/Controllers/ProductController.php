<?php


namespace App\Http\Controllers;


use App\Service\ProductPrice;
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
            $priceCalculator = new ProductPrice($request->only(array_keys($this->rules())));

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
            'shutter_type' => 'required',
            'corner' => 'required',
            'color' => 'required',
            'frame' => 'required'
        ];
    }
}