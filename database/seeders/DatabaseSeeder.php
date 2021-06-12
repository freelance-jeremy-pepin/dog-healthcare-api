<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Database\Seeders\UserSeed');
        $this->call('Database\Seeders\TimeIntervalSeed');
        $this->call('Database\Seeders\ProfessionalTypeSeed');
        $this->call('Database\Seeders\DogSeed');
    }
}
