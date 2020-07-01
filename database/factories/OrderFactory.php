<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\PricePlan;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $someDayInFuture = now()
        ->addDays($faker->numberBetween(1, 5))
        ->format('Y-m-d');
    return [
        'price_plan_id' => PricePlan::all()->pluck('id')->random(),
        'delivery_day' => $someDayInFuture
    ];
});
