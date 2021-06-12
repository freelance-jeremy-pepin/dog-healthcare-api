<?php

namespace Database\Seeders;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Database\Seeder;

class DogSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where(['email' => 'demo@demo.com'])->first();

        $dog = Dog::updateOrCreate(
            ['name' => 'MEDOR'],
            [
                'user_id' => $user->id,
                'name' => 'MEDOR',
                'breed' => 'Labrador',
                'birthday' => '2020-03-12'
            ]
        );

        $user->active_dog_id = $dog->id;
        $user->save();
    }
}
