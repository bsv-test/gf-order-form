<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price_plan_id', 'delivery_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pricePlan()
    {
        return $this->hasOne(PricePlan::class);
    }
}
