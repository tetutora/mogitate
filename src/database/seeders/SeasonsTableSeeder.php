<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = ['spring', 'summer', 'autumn', 'winter'];

        foreach ($seasons as $season)
        {
            Season::create(['name' => $season]);
        }
    }
}
