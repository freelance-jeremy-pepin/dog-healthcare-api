<?php

namespace App\Request;

class ReminderValidation
{
    public static function rules()
    {
        return [
            'time_interval_id' => 'required|integer',
            'dog_id' => 'required|integer',
            'number_time_interval' => 'required|integer',
            'table_name' => 'required|string|max:255',
            'next_reminder' => 'required|date'
        ];
    }
}
