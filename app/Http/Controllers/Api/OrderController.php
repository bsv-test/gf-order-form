<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {
        $normalizedData = $request->normalized();

        $user = User::firstOrNew(['phone' => $normalizedData['user']['phone']]);
        $user->fill($normalizedData['user']);
        if ($user->isDirty()) {
            $user->save();
        }

        $order = new Order($normalizedData['order']);
        $order->user()->associate($user);
        $order->save();

        return response()->json(['status' => 'success']);
    }
}
