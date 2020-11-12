<?php

namespace App\Request;

class DewormingValidation
{
    public static function rules()
    {
        return [
            'dog_id' => 'required|integer',
            'cared_by_professional_id' => 'integer',
            'date' => 'required|date',
            'deworming_name' => 'required|string|max:255',
            'cared_by_owner' => 'required|boolean',
            'notes' => 'string'
        ];
    }
}
