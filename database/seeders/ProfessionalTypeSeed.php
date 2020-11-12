<?php

namespace Database\Seeders;

use App\Models\ProfessionalType;
use Illuminate\Database\Seeder;

class ProfessionalTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfessionalType::updateOrCreate(
            [
                'internal_label' => 'veterinary',
                'display_label' => 'Vétérinaire'
            ]
        );
        ProfessionalType::updateOrCreate(
            [
                'internal_label' => 'groomer',
                'display_label' => 'Toiletteur'
            ]
        );
    }
}
