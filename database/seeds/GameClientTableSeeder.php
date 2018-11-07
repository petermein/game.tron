<?php

use Illuminate\Database\Seeder;

class GameClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('game_clients')->insert([
            'os' => \App\Enums\DeviceOS::ANDROID,
            'version' => '0.1',
            'user_id' => 1,
            'device_token' => 'abc123',
        ]);
    }
}
