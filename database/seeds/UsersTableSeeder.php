<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first' => 'Wes',
            'last' => 'Dollar',
            'email' => 'wdollar@callingpost.com',
            'password' => bcrypt('supersecretpassword'),
        ]);
    }
}
