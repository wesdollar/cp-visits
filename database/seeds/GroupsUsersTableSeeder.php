<?php

use App\GroupUser;
use Illuminate\Database\Seeder;

class GroupsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupUser::create(
            ['group_id' => '1', 'user_id' => '1']
        );
    }
}
