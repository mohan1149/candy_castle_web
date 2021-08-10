<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $currencies = [
            [
                'currency' => 'Kuwaiti Dinar',
                'currency_code' => 'KWD',
                'is_default' => 1,
                'is_base' => 1,
                'base_multiplier' => 1.0,
            ],
            [
                'currency' => 'Indian Rupee',
                'currency_code' => 'INR',
                'is_default' => 0,
                'is_base' => 0,
                'base_multiplier' => 245,
            ],
            [
                'currency' => 'US Dollor',
                'currency_code' => 'USD',
                'is_default' => 0,
                'is_base' => 0,
                'base_multiplier' => 3.4,
            ],
            [
                'currency' => 'UAE Dirham',
                'currency_code' => 'AED',
                'is_default' => 0,
                'is_base' => 0,
                'base_multiplier' => 12.25,
            ],
        ];
        DB::table('currencies')->insert($currencies);
    }
}
