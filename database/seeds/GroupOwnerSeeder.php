<?php

use App\GroupOwner;
use Illuminate\Database\Seeder;

class GroupOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'group_id' => '1',
            'user_id' => '1',
        ];

        GroupOwner::create($data);
    }
}
