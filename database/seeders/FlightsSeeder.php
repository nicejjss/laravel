<?php

namespace Database\Seeders;

use App\Models\Flights;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FlightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('flights')->insert([
//            'name' => Str::random(10),
//            'flight_up' =>date('Y-m-d H-m-s'),
//        ]);
        Flights::factory()
            ->count(2)
            ->make();
    }
}
