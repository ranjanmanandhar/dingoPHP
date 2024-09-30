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
            ['name' => 'New South Wales', 'state_code' => 'NSW'],
            ['name' => 'Victoria', 'state_code' => 'VIC'],
            ['name' => 'Queensland', 'state_code' => 'QLD'],
            ['name' => 'Western Australia', 'state_code' => 'WA'],
            ['name' => 'South Australia', 'state_code' => 'SA'],
            ['name' => 'Tasmania', 'state_code' => 'TAS'],
            ['name' => 'Australian Capital Territory', 'state_code' => 'ACT'],
            ['name' => 'Northern Territory', 'state_code' => 'NT'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
