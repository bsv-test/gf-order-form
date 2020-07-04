<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_plans')->insert([
            [
                'name' => 'Стандартный',
                'price' => 1000,
                'delivery_days' => json_encode(range(1, 5))
            ],
            [
                'name' => 'Выходной',
                'price' => 700,
                'delivery_days' => json_encode([6, 0])
            ],
            [
                'name' => 'Великолепная среда',
                'price' => 500,
                'delivery_days' => json_encode([3])
            ],
        ]);
        // dd(DB::table('price_plans'));
    }
}
