<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Dingo\Api\Exception\ValidationHttpException;
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

    /**
     * src: https://medium.com/@latheesankanesamoorthy/get-validation-error-messages-in-lumen-dingo-api-project-44e464a38936
     * Override validate method use dingo validation exception
     *
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    public function validate(
        Request $request, array $rules, array $messages = [], array $customAttributes = []
    )
    {
        $validator = $this->getValidationFactory()->make(
            $request->all(),
            $rules,
            $messages,
            $customAttributes
        );

        if ($validator->fails()) {
            throw new ValidationHttpException(
                $validator->errors()
            );
        }
    }

    protected function respondOk($data)
    {
        return response()->json($data);
    }

    protected function relations(Request $request)
    {
        return explode(',', $request->query('relations'));
    }
}
