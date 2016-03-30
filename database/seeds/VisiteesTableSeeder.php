<?php

use App\Visitee;
use Illuminate\Database\Seeder;

class VisiteesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 6;

        for($i = 0; $i < $limit; $i++) {

            $data = [
                'first' => $faker->firstName,
                'last' => $faker->lastName,
                'address' => $faker->streetAddress,
                'city' => 'Augusta',
                'state' => 'GA',
                'zip' => '30904',
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->email
            ];

            Visitee::create($data);
        }
    }
}
