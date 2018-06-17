<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['daily', 'weekly', 'bi-monthly', 'monthly', 'bi-yearly', 'tri-yearly', 'yearly'];
        $roles = ['member', 'seller', 'afa', 'apl'];
        $cost = 10;
        foreach($roles as $role){
            foreach($types as $type){
                DB::table('plans')->insert([
                    'slug' => $role.'-'.$type,
                    'name' => ucfirst($role).' '.ucfirst($type),
                    'cost' => $cost,
                    'type' => $type,
                    'role' => $role,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);
                $cost += 3;
            }
        }
        
    }
}
