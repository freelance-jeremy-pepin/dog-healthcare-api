<?php

namespace Database\Seeders;

use App\Models\TimeInterval;
use Illuminate\Database\Seeder;

class TimeIntervalSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeInterval::updateOrCreate(['internal_label' => 'year', 'display_label' => 'An', 'format' => 'year']);
        TimeInterval::updateOrCreate(['internal_label' => 'month', 'display_label' => 'Mois', 'format' => 'month']);
        TimeInterval::updateOrCreate(['internal_label' => 'week', 'display_label' => 'Semaine', 'format' => 'week']);
        TimeInterval::updateOrCreate(['internal_label' => 'day', 'display_label' => 'Jour', 'format' => 'day']);
    }
}
