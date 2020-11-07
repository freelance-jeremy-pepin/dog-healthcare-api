<?php

namespace App\Request;

class AntiParasiticValidation
{
    public static function rules()
    {
        return [
            'dog_id' => 'required|integer',
            'cared_by_professional_id' => 'required|integer',
            'date' => 'required|date',
            'anti_parasitic_name' => 'required|string|max:255',
            'cared_by_owner' => 'required|boolean',
            'notes' => 'string'
        ];
    }
}
