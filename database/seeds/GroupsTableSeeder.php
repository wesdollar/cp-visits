<?php

use App\Group;
use Illuminate\Database\Seeder;


class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'name' => 'ACME Church',
                'city' => 'Augusta',
                'state' => 'GA',
                'zip' => '30907',
                'active' => 'true',
            ],
            [
                'name' => 'Bad News Bears',
                'city' => 'Augusta',
                'state' => 'GA',
                'zip' => '30904',
                'active' => 'true',
            ],
            [
                'name' => 'Dixie Lodge',
                'city' => 'North Augusta',
                'state' => 'SC',
                'zip' => '29841',
                'active' => 'true',
            ],
            [
                'name' => 'Doe Metal Works',
                'city' => 'North Augusta',
                'state' => 'SC',
                'zip' => '29841',
                'active' => 'false',
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
