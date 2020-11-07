<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalType;
use App\Request\ProfessionalTypeValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProfessionalTypeController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var ProfessionalType|Builder
     */
    private $query;

    /**
     * ProfessionalTypeController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = ProfessionalType::relations($this->relations($request));
    }

    /**
     * Créer un nouveau type de professionnel.
     * @return int Id du nouveau poids
     */
    public function create(): int
    {
        $this->validate($this->request, ProfessionalTypeValidation::rules());

        $professionalType = new ProfessionalType($this->request->all());
        $professionalType->save();

        return $professionalType->id;
    }

    /**
     * Récupère tous les types de professionnel.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $professionalTypes = $this->query->get();

        return $this->respondOk($professionalTypes);
    }

    /**
     * Récupère un type de professionnel par son ID.
     * @param $id integer Id du poids.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $professionalType = $this->getProfessionalType($id);

        return $this->respondOk($professionalType);
    }

    /**
     * Met à jour un type de professionnel.
     * @param int $id
     * @return void
     * @throws HttpException
     */
    public function update(int $id): void
    {
        $professionalType = $this->getProfessionalType($id);

        $professionalType->update($this->request->all());
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
        $professionalType = $this->getProfessionalType($id);

        $professionalType->delete();
    }


    /**
     * @param int $id
     * @return ProfessionalType
     */
    private function getProfessionalType(int $id): ProfessionalType
    {
        $professionalType = $this->query->find($id);

        if ($professionalType === null) {
            abort(404, 'Ce type de professionnel n\'existe pas.');
        }

        return $professionalType;
    }
}
