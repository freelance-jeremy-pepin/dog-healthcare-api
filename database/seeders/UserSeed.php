<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'demo@demo.com'],
            [
                'email' => 'demo@demo.com',
                'password' => app('hash')->make('demo'),
                'firstname' => 'Demo',
                'lastname' => 'DEMO'
            ]
        );
    }
}
