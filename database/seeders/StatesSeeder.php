<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data for Australian states and territories with abbreviations
        $states = [
            ['name' => 'New South Wales', 'abbreviation' => 'NSW'],
            ['name' => 'Victoria', 'abbreviation' => 'VIC'],
            ['name' => 'Queensland', 'abbreviation' => 'QLD'],
            ['name' => 'Western Australia', 'abbreviation' => 'WA'],
            ['name' => 'South Australia', 'abbreviation' => 'SA'],
            ['name' => 'Tasmania', 'abbreviation' => 'TAS'],
            ['name' => 'Australian Capital Territory', 'abbreviation' => 'ACT'],
            ['name' => 'Northern Territory', 'abbreviation' => 'NT'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
