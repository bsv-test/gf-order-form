<?php

namespace App\Http\Controllers;

use App\Models\PricePlan;

class OrderController extends Controller
{
    public function create()
    {
        $pricePlans = (new PricePlan())->presentAll();
        return view('orders.create', compact('pricePlans'));
    }
}
