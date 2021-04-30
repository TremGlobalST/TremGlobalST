<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'title' => 'London',
            'slug'  => 'london',
            'theme' => '#ec6724'
        ]);
        DB::table('rooms')->insert([
            'title' => 'Istanbul',
            'slug'  => 'istanbul',
            'theme' => '#365491'
        ]);
    }
}
