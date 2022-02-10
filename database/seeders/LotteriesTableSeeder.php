<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lottery;

class LotteriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lotteries = [
            ['name' => 'Monday Special','country_id' => 1],
            ['name' => 'Lucky Tuesday','country_id' => 1],
            ['name' => 'Midweek Wednesday','country_id' => 1],
            ['name' => 'Thursday','country_id' => 1],
            ['name' => 'Friday Bonanza','country_id' => 1],
            ['name' => 'National','country_id' => 1],
            ['name' => 'Sunday Special','country_id' => 1],
            ['name' => 'International Lottery','country_id' => 1],
        ];
        foreach($lotteries as $lottery)
        {
            Lottery::create($lottery);
        }
    }
}
