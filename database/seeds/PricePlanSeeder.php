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
                'price_pennies' => 1000_00,
                'delivery_days' => json_encode(range(1, 5))
            ],
            [
                'name' => 'Выходной',
                'price_pennies' => 700_00,
                'delivery_days' => json_encode([6, 7])
            ],
            [
                'name' => 'Великолепная среда',
                'price_pennies' => 500_00,
                'delivery_days' => json_encode([3])
            ],
        ]);
        // dd(DB::table('price_plans'));
    }
}
