<?php

namespace App\Request;

class ProfessionalValidation
{
    public static function rules()
    {
        return [
            'professional_type_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone_number' => 'string|max:15',
            'mobile_number' => 'string|max:15',
            'address' => 'string|max:255',
            'city' => 'string|max:45',
            'zip_code' => 'string|max:10',
            'email' => 'string|max:180',
            'notes' => 'string',
        ];
    }
}
