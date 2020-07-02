<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user.name' => 'required|string|min:2',
            'user.phone' => 'required|string|min:9',
            'order.price_plan_id' => 'exists:App\PricePlan,id',
            'order.delivery_day' => 'date',
        ];
    }
}
