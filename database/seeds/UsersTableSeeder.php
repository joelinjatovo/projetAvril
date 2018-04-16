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
            'name' => "admin",
            'email' => 'admin@iea.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => "apl",
            'email' => 'apl@iea.com',
            'password' => bcrypt('apl'),
            'role' => 'apl',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => "afa",
            'email' => 'afa@iea.com',
            'password' => bcrypt('afa'),
            'role' => 'afa',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => "seller",
            'email' => 'seller@iea.com',
            'password' => bcrypt('seller'),
            'role' => 'seller',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('users')->insert([
            'name' => "member",
            'email' => 'member@iea.com',
            'password' => bcrypt('member'),
            'role' => 'member',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
