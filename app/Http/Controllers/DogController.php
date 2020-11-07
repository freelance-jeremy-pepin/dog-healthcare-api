<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Request\DogValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * Créer un nouveau chien.
     * @return int Id du nouveau chien
     */
    public function create(): int
    {
        $this->validate($this->request, DogValidation::rules());

        $dog = new Dog($this->request->all());
        $dog->user_id = Auth::id();
        $dog->save();

        return $dog->id;
    }

    /**
     * Récupère tous les chiens.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $dogs = $this->query->where('user_id', Auth::id())->get();

        return $this->respondOk($dogs);
    }

    /**
     * Récupère un chien par son ID.
     * @param $id integer Id du chien.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $dog = $this->getDog($id);

        return $this->respondOk($dog);
    }

    /**
     * Met à jour un chien.
     * @param int $id
     * @return void
     * @throws HttpException
     */
    public function update(int $id): void
    {
        $dog = $this->getDog($id);

        $dog->update($this->request->all());
    }

    /**
     * Supprime un chien.
     * @param int $id
     * @return void
     * @throws HttpException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $dog = $this->getDog($id);

        $dog->delete();
    }

    /**
     * @param int $id
     * @return Dog
     */
    private function getDog(int $id): Dog
    {
        $dog = $this->query->where('user_id', Auth::id())->find($id);

        if ($dog === null) {
            abort(404, 'Ce chien n\'existe pas.');
        }

        return $dog;
    }
}
