<?php

namespace App\Presenters;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

trait PricePlanPresenter
{
    public function present()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'deliveryDaysPresented' => $this->presentDeliveryDays(),
            'possibleDeliveryDateOptions' => $this->getDeliveryDateOptions(),
        ];
    }

    public function presentAll()
    {
        return self::all()->map(fn ($item) => $item->present());
    }

    public function presentDeliveryDays()
    {
        if (!array_key_exists('delivery_days', $this->attributes)) {
            return '';
        }
        return collect($this->delivery_days)
            ->map(fn($item) => Carbon::now()->next($item)->translatedFormat('D'))
            ->map(fn($item) => Str::substr($item, 0, 2))
            ->join(', ');
    }

    public function getDeliveryDateOptions()
    {
        if (!array_key_exists('delivery_days', $this->attributes)) {
            return [];
        }
        return collect($this->getPossibleDeliveryDatesAttribute())
            ->mapWithKeys(function ($item) {
                $date = Carbon::parse($item);
                $shortDayName = Str::substr($date->translatedFormat('D'), 0, 2);
                return [$item => Carbon::parse($item)->format("d.m.Y ({$shortDayName})")];
            })
            ->toArray() ;
    }
}
