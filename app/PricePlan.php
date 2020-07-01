<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    public function getPrice(): int
    {
        return floor($this->attributes['price_pennies'] / 100);
    }

    public function getDeliveryDaysAttribute(): array
    {
        return json_decode($this->attributes['delivery_days'], true);
    }
}
