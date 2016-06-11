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
            'name' => 'Administrator',
            'email' => 'aminurizam@gmail.com',
            'password' => bcrypt('password'),
            'user_group' => 'admin',
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
