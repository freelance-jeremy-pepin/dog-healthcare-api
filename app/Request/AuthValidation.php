<?php


namespace App\Request;


class AuthValidation
{
    public static function rules()
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:user',
            'password' => 'required|confirmed',
        ];
    }
}
