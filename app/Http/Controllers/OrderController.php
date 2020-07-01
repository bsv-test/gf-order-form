<?php

namespace App\Http\Controllers;

use App\Order;
use App\PricePlan;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $pricePlans = PricePlan::get();
        return view('orders.create', compact('pricePlans'));
    }
}
