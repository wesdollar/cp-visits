<?php

use Illuminate\Database\Seeder;
use App\UsState;

class UsStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('us_states')->truncate();
        UsState::create(['name' => 'Alaska', 'abbr' => 'AK']);
        UsState::create(['name' => 'Alabama', 'abbr' => 'AL']);
        UsState::create(['name' => 'Arizona', 'abbr' => 'AZ']);
        UsState::create(['name' => 'Arkansas', 'abbr' => 'AR']);
        UsState::create(['name' => 'California', 'abbr' => 'CA']);
        UsState::create(['name' => 'Colorado', 'abbr' => 'CO']);
        UsState::create(['name' => 'Connecticut', 'abbr' => 'CT']);
        UsState::create(['name' => 'Delaware', 'abbr' => 'DE']);
        UsState::create(['name' => 'District of Columbia', 'abbr' => 'DC']);
        UsState::create(['name' => 'Florida', 'abbr' => 'FL']);
        UsState::create(['name' => 'Georgia', 'abbr' => 'GA']);
        UsState::create(['name' => 'Hawaii', 'abbr' => 'HI']);
        UsState::create(['name' => 'Idaho', 'abbr' => 'ID']);
        UsState::create(['name' => 'Illinois', 'abbr' => 'IL']);
        UsState::create(['name' => 'Indiana', 'abbr' => 'IN']);
        UsState::create(['name' => 'Iowa', 'abbr' => 'IA']);
        UsState::create(['name' => 'Kansas', 'abbr' => 'KS']);
        UsState::create(['name' => 'Kentucky', 'abbr' => 'KY']);
        UsState::create(['name' => 'Louisiana', 'abbr' => 'LA']);
        UsState::create(['name' => 'Maine', 'abbr' => 'ME']);
        UsState::create(['name' => 'Maryland', 'abbr' => 'MD']);
        UsState::create(['name' => 'Massachusetts', 'abbr' => 'MA']);
        UsState::create(['name' => 'Michigan', 'abbr' => 'MI']);
        UsState::create(['name' => 'Minnesota', 'abbr' => 'MN']);
        UsState::create(['name' => 'Mississippi', 'abbr' => 'MS']);
        UsState::create(['name' => 'Missouri', 'abbr' => 'MO']);
        UsState::create(['name' => 'Montana', 'abbr' => 'MT']);
        UsState::create(['name' => 'Nebraska', 'abbr' => 'NE']);
        UsState::create(['name' => 'Nevada', 'abbr' => 'NV']);
        UsState::create(['name' => 'New Hampshire', 'abbr' => 'NH']);
        UsState::create(['name' => 'New Jersey', 'abbr' => 'NJ']);
        UsState::create(['name' => 'New Mexico', 'abbr' => 'NM']);
        UsState::create(['name' => 'New York', 'abbr' => 'NY']);
        UsState::create(['name' => 'North Carolina', 'abbr' => 'NC']);
        UsState::create(['name' => 'North Dakota', 'abbr' => 'ND']);
        UsState::create(['name' => 'Ohio', 'abbr' => 'OH']);
        UsState::create(['name' => 'Oklahoma', 'abbr' => 'OK']);
        UsState::create(['name' => 'Oregon', 'abbr' => 'OR']);
        UsState::create(['name' => 'Pennsylvania', 'abbr' => 'PA']);
        UsState::create(['name' => 'Puerto Rico', 'abbr' => 'PR']);
        UsState::create(['name' => 'Rhode Island', 'abbr' => 'RI']);
        UsState::create(['name' => 'South Carolina', 'abbr' => 'SC']);
        UsState::create(['name' => 'South Dakota', 'abbr' => 'SD']);
        UsState::create(['name' => 'Tennessee', 'abbr' => 'TN']);
        UsState::create(['name' => 'Texas', 'abbr' => 'TX']);
        UsState::create(['name' => 'Utah', 'abbr' => 'UT']);
        UsState::create(['name' => 'Vermont', 'abbr' => 'VT']);
        UsState::create(['name' => 'Virginia', 'abbr' => 'VA']);
        UsState::create(['name' => 'Washington', 'abbr' => 'WA']);
        UsState::create(['name' => 'West Virginia', 'abbr' => 'WV']);
        UsState::create(['name' => 'Wisconsin', 'abbr' => 'WI']);
        UsState::create(['name' => 'Wyoming', 'abbr' => 'WY']);
    }
}
