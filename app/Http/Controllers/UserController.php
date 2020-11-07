<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getMe(Request $request)
    {
        $user = User::relations($this->relations($request))->findOrFail(Auth::id());
        return $this->respondOk($user);
    }

    /**
     * Get all User.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        return $this->respondOk(User::relations($this->relations($request))->all());
    }

    /**
     * Get one user.
     *
     * @param $id integer Id de l'utilisateur
     * @param Request $request
     * @return JsonResponse
     */
    public function getById(int $id, Request $request)
    {
        try {
            $user = User::relations($this->relations($request))->findOrFail($id);
            return $this->respondOk($user);
        } catch (ModelNotFoundException $e) {
            return $this->respondError('Utilisateur non trouvé.', 404);
        }
    }
}
