<?php

namespace App\Http\Controllers;

use App\Models\AntiParasitic;
use App\Request\AntiParasiticValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AntiParasiticController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var AntiParasitic|Builder
     */
    private $query;

    /**
     * AntiParasiticController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = AntiParasitic::relations($this->relations($request));
    }

    /**
     * Créer un nouveau anti-parasitaire.
     * @return JsonResponse Nouveau anti-parasitaire.
     */
    public function create(): JsonResponse
    {
        $this->validate($this->request, AntiParasiticValidation::rules());

        $antiParasitic = new AntiParasitic($this->request->all());
        $antiParasitic->save();

        return $this->respondOk($this->getAntiParasitic($antiParasitic->id));
    }

    /**
     * Récupère tous les anti-parasitaires.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $antiParasitics = $this->query->get();

        return $this->respondOk($antiParasitics);
    }

    /**
     * Récupère tous les anti-parasitaires d'un chien.
     * @param int $dogId
     * @return JsonResponse
     */
    public function getAllByDog(int $dogId): JsonResponse
    {
        $dewormings = $this->query->where('dog_id', $dogId)->get();

        return $this->respondOk($dewormings);
    }

    /**
     * Récupère un anti-parasitaire par son ID.
     * @param $id integer Id du anti-parasitaire.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $antiParasitic = $this->getAntiParasitic($id);

        return $this->respondOk($antiParasitic);
    }

    /**
     * Récupère le dernier anti-parasitaire d'un chien.
     * @param $dogId integer Id du chien.
     * @return JsonResponse
     */
    public function getLastByDog(int $dogId): JsonResponse
    {
        $antiParasitic = $this->query->orderBy('date', 'desc')->where('dog_id', $dogId)->first();

        return $this->respondOk($antiParasitic);
    }

    /**
     * Met à jour un anti-parasitaire.
     * @param int $id
     * @return JsonResponse Anti-parasitaire modifié.
     */
    public function update(int $id): JsonResponse
    {
        $antiParasitic = $this->getAntiParasitic($id);

        $antiParasitic->update($this->request->all());

        return $this->respondOk($this->getAntiParasitic($id));
    }

    /**
     * Supprime un anti-parasitaire.
     * @param int $id
     * @return void
     * @throws HttpException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $antiParasitic = $this->getAntiParasitic($id);

        $antiParasitic->delete();
    }


    /**
     * @param int $id
     * @return AntiParasitic
     */
    private function getAntiParasitic(int $id): AntiParasitic
    {
        $antiParasitic = $this->query->find($id);

        if ($antiParasitic === null) {
            abort(404, 'Cet anti-parasitaire n\'existe pas.');
        }

        return $antiParasitic;
    }
}
