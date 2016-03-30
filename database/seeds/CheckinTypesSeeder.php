<?php

use Illuminate\Database\Seeder;

class CheckinTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checkinTypes = [
            ['name' => 'Visited'],
            ['name' => 'Called'],
            ['name' => 'Sent Gift'],
            ['name' => 'Delivered Meal'],
        ];

        foreach ($checkinTypes as $type) {
            \App\CheckinType::create([
                'name' => $type['name'],
                'active' => true
            ]);
        }
    }
}
