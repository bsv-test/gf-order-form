<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\PricePlan;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $pricePlanId = PricePlan::pluck('id')->random();
    $pricePlan = PricePlan::find($pricePlanId);
    $deliveryDate = collect($pricePlan->possible_delivery_dates)->random();
    return [
        'price_plan_id' => $pricePlanId,
        'delivery_date' => $deliveryDate
    ];
});
