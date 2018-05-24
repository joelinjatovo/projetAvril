<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            'Australian Capital Territory',
            'New South Wales',
            'Norfolk Island',
            'Northern Territory',
            'Queensland',
            'South Australia',
            'Tasmania',
            'Victoria',
            'Western Australia'
        ];
        foreach($items as $item){
            DB::table('states')->insert([
                'content' => $item,
                'country' => "aus",
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        
        DB::table('states')->insert([
            'content' => "Nouvelle Zélande",
            'country' => "nzl",
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
