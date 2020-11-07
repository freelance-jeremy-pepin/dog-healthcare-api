<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Request\WeightValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WeightController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Weight|Builder
     */
    private $query;

    /**
     * WeightController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Weight::relations($this->relations($request));
    }

    /**
     * Créer un nouveau poids.
     * @return int Id du nouveau poids.
     */
    public function create(): int
    {
        $this->validate($this->request, WeightValidation::rules());

        $weight = new Weight($this->request->all());
        $weight->save();

        return $weight->id;
    }

    /**
     * Récupère tous les poids.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $weights = $this->query->get();

        return $this->respondOk($weights);
    }

    /**
     * Récupère un poids par son ID.
     * @param $id integer Id du poids.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $weight = $this->getWeight($id);

        return $this->respondOk($weight);
    }

    /**
     * Met à jour un poids.
     * @param int $id
     * @return void
     * @throws HttpException
     */
    public function update(int $id): void
    {
        $weight = $this->getWeight($id);

        $weight->update($this->request->all());
    }

    /**
     * Supprime un poids.
     * @param int $id
     * @return void
     * @throws HttpException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $weight = $this->getWeight($id);

        $weight->delete();
    }


    /**
     * @param int $id
     * @return Weight
     */
    private function getWeight(int $id): Weight
    {
        $weight = $this->query->find($id);

        if ($weight === null) {
            abort(404, 'Ce poids n\'existe pas.');
        }

        return $weight;
    }
}
