<?php

use Illuminate\Database\Seeder;

class VisiteeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visiteeCategories = [
            ['name' => 'Home-bound'],
            ['name' => 'Sick'],
            ['name' => 'Hospitalized'],
            ['name' => 'Help Needed'],
        ];

        foreach ($visiteeCategories as $category) {
            \App\VisiteeCategory::create([
                'name' => $category['name'],
                'active' => true
            ]);
        }
    }
}
