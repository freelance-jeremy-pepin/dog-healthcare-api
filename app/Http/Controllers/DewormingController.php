<?php

namespace App\Http\Controllers;

use App\Models\Deworming;
use App\Request\DewormingValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DewormingController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Deworming|Builder
     */
    private $query;

    /**
     * DewormingController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Deworming::relations($this->relations($request));
    }

    /**
     * Créer un nouveau vermifuge.
     * @return JsonResponse Nouveau vermifuge.
     */
    public function create(): JsonResponse
    {
        $this->validate($this->request, DewormingValidation::rules());

        $deworming = new Deworming($this->request->all());
        $deworming->save();

        return $this->respondOk($this->getDeworming($deworming->id));
    }

    /**
     * Récupère tous les vermifuges.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $dewormings = $this->query->get();

        return $this->respondOk($dewormings);
    }

    /**
     * Récupère tous les vermifuges d'un chien.
     * @param int $dogId
     * @return JsonResponse
     */
    public function getAllByDog(int $dogId): JsonResponse
    {
        $dewormings = $this->query->where('dog_id', $dogId)->orderBy('date')->get();

        return $this->respondOk($dewormings);
    }

    /**
     * Récupère un vermifuge par son ID.
     * @param $id integer Id du vermifuge.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $deworming = $this->getDeworming($id);

        return $this->respondOk($deworming);
    }

    /**
     * Récupère le dernier vermifuge d'un chien.
     * @param $dogId integer Id du chien.
     * @return JsonResponse
     */
    public function getLastByDog(int $dogId): JsonResponse
    {
        $deworming = $this->query->orderBy('date', 'desc')->where('dog_id', $dogId)->first();

        return $this->respondOk($deworming);
    }

    /**
     * Met à jour un vermifuge.
     * @param int $id
     * @return JsonResponse Vermifuge modifié.
     */
    public function update(int $id): JsonResponse
    {
        $deworming = $this->getDeworming($id);

        $deworming->update($this->request->all());

        return $this->respondOk($this->getDeworming($id));
    }

    /**
     * Supprime un vermifuge.
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $deworming = $this->getDeworming($id);

        $deworming->delete();
    }


    /**
     * @param int $id
     * @return Deworming
     */
    private function getDeworming(int $id): Deworming
    {
        $deworming = $this->query->find($id);

        if ($deworming === null) {
            abort(404, 'Ce vermifuge n\'existe pas.');
        }

        return $deworming;
    }
}
