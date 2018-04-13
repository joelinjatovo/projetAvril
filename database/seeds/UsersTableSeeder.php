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
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'state' => 'active',
            'password' => bcrypt('admin'),
            'parent_id' => '0',
        ]);
        DB::table('users')->insert([
            'name' => "joelinjatovo",
            'email' => 'joelinjatovo@gmail.com',
            'role' => 'admin',
            'state' => 'active',
            'password' => bcrypt('joelinjatovo'),
            'parent_id' => '0',
        ]);
    }
}
