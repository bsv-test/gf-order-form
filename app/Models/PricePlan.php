<?php

namespace App\Models;

use App\Presenters\PricePlanPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PricePlan extends Model
{
    use PricePlanPresenter;

    protected $appends = [
        'possible_delivery_dates'
    ];

    public function getDeliveryDaysAttribute(): array
    {
        return json_decode($this->attributes['delivery_days'], true);
    }

    public function getPossibleDeliveryDatesAttribute(): array
    {
        return collect($this->delivery_days)
            ->map(fn($weekDay) => Carbon::now()->endOfWeek()->next($weekDay)->toDateString())
            ->toArray();
    }
}
