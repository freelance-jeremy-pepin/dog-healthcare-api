<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var User|Builder
     */
    private $query;

    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = User::relations($this->relations($request));
    }

    /**
     * Récupère l'utilisateur connecté.
     *
     * @return JsonResponse
     */
    public function getMe(): JsonResponse
    {
        return $this->respondOk(
            $this->query->findOrFail(Auth::id())
        );
    }

    /**
     * Récupère tous les utilisateurs.
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return $this->respondOk(
            $this->query->get()
        );
    }

    /**
     * Récupère un utilisateur par son ID.
     *
     * @param $id integer Id de l'utilisateur.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        try {
            return $this->respondOk(
                $this->query->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->respondError('Utilisateur non trouvé.', 404);
        }
    }
}
