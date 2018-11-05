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
        \DB::table('users')->insert([
            'name' => 'Peter',
            'email' => 'petermein@gmail.com',
            'password' => bcrypt('secret'),
            'team_id' => 1,
        ]);
    }
}
