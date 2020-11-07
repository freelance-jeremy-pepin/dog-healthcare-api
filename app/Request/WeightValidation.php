<?php

namespace App\Request;

class WeightValidation
{
    public static function rules()
    {
        return [
            'dog_id' => 'required|integer',
            'date' => 'required|date',
            'weight' => 'required|numeric'
        ];
    }
}
