<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //Add this method to the Controller class
    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60
            ],
            200
        );
    }

    protected function respondOk($data)
    {
        return response()->json([$data], 200);
    }

    protected function respondError($message, $code)
    {
        return Handler::errorJson($message, $code);
    }

    protected function relations(Request $request)
    {
        return explode(',', $request->query('relations'));
    }
}
