<?php

namespace App\Http\Requests;

use App\Models\PricePlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
{
    public function rules(): array
    {
        $pricePlanId = $this->input('order.price_plan_id');
        $pricePlan = PricePlan::find($pricePlanId);
        $possibleDeliveryDates = $pricePlan ? $pricePlan->possible_delivery_dates : [];
        return [
            'user.name' => 'required|string|min:2',
            'user.phone' => 'required|string|min:9',
            'order.price_plan_id' => 'exists:App\Models\PricePlan,id',
            'order.delivery_date' => ['bail', 'required', Rule::in($possibleDeliveryDates)]
        ];
    }

    // FIXME: mb move to another place
    public function normalized()
    {
        ['user' => $user, 'order' => $order] = $this->validated();
        return [
            'user' => [
                'name' => preg_replace('/[^a-zа-яё\- ]+/iu', '', $user['name']),
                'phone' => preg_replace('/[^0-9]+/iu', '', $user['phone'])
            ],
            'order' => $order
        ];
    }
}
