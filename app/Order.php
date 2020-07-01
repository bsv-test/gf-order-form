<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price_plan_id', 'delivery_day'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
