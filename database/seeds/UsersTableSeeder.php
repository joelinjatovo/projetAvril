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
            'email' => 'joelinjatovo@gmail.com',
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
            'location_id' => 2,
        ]);
        DB::table('users')->insert([
            'name' => "apl1",
            'email' => 'apl1@iea.com',
            'password' => bcrypt('apl'),
            'role' => 'apl',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 1,
        ]);
        DB::table('users')->insert([
            'name' => "apl2",
            'email' => 'apl2@iea.com',
            'password' => bcrypt('apl'),
            'role' => 'apl',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 3,
        ]);
        DB::table('users')->insert([
            'name' => "apl3",
            'email' => 'apl3@iea.com',
            'password' => bcrypt('apl'),
            'role' => 'apl',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 3,
        ]);
        DB::table('users')->insert([
            'name' => "afa",
            'email' => 'afa@iea.com',
            'password' => bcrypt('afa'),
            'role' => 'afa',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 4,
        ]);
        DB::table('users')->insert([
            'name' => "afa3",
            'email' => 'afa3@iea.com',
            'password' => bcrypt('afa3'),
            'role' => 'afa',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 5,
        ]);
        DB::table('users')->insert([
            'name' => "afa2",
            'email' => 'afa2@iea.com',
            'password' => bcrypt('afa2'),
            'role' => 'afa',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'location_id' => 3,
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
            'email' => 'haja.emediaplace@gmail.com',
            'password' => bcrypt('member'),
            'role' => 'member',
            'status' => 'active',
            'author_id' => '0',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
