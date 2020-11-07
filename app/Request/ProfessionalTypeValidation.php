<?php

namespace App\Request;

class ProfessionalTypeValidation
{
    public static function rules()
    {
        return [
            'internal_label' => 'required|string',
            'display_label' => 'required|string'
        ];
    }
}
