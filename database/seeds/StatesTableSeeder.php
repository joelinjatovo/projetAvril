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
            [
                'AU-ACT',
                'Australian Capital Territory',
            ],
            [
                'AU-NSW',
                'New South Wales',
            ],
            [
                '',
                'Norfolk Island',
            ],
            [
                'AU-NT',
                'Northern Territory',
            ],
            [
                'AU-QLD',
                'Queensland',
            ],
            [
                'AU-SA',
                'South Australia',
            ],
            [
                'AU-TAS',
                'Tasmania',
            ],
            [
                'AU-VIC',
                'Victoria',
            ],
            [
                'AU-WA',
                'Western Australia'
            ],
        ];
        foreach($items as $item){
            DB::table('states')->insert([
                'code' => $item[0],
                'content' => $item[1],
                'country' => "AU",
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
