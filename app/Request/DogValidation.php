<?php

namespace App\Request;

class DogValidation
{
    public static function rules()
    {
        return [
            'name' => 'required|string',
            'breed' => 'required|string',
            'birthday' => 'required|date',
            'comments' => 'string',
        ];
    }
}
