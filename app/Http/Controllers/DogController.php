<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DogController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Dog|Builder
     */
    private $query;

    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Dog::relations($this->relations($request));
    }

    /**
     * Récupère tous les chiens.
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
     * Récupère un chien par son ID.
     *
     * @param $id integer Id du chien.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        try {
            return $this->respondOk(
                $this->query->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return $this->respondError('Chien non trouvé.', 404);
        }
    }
}
