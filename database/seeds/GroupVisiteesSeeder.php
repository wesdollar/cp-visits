<?php

use App\GroupVisitee;
use Illuminate\Database\Seeder;

class GroupVisiteesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 7; $i <= 12; $i++) {
            $data = [
                'group_id' => '1',
                'visitee_id' => $i
            ];
            GroupVisitee::create($data);
        }
    }
}
