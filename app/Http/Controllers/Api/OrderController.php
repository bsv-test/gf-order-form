<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Order;
use App\User;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $validatedRequestData = $request->validated();

        $user = User::firstOrNew(['phone' => $request->input('user.phone')]);
        $user->fill($validatedRequestData['user']);
        if ($user->isDirty()) {
            $user->save();
        }

        $order = new Order($validatedRequestData['order']);
        $order->user()->associate($user);
        $order->save();

        return response()->json(['status' => 'success']);
    }
}
