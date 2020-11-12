<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Request\ProfessionalValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProfessionalController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Professional|Builder
     */
    private $query;

    /**
     * ProfessionalController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Professional::relations($this->relations($request));
    }

    /**
     * Créer un nouveau professionnel.
     * @return JsonResponse Nouveau professionnel.
     */
    public function create(): JsonResponse
    {
        $this->validate($this->request, ProfessionalValidation::rules());

        $professional = new Professional($this->request->all());
        $professional->user_id = Auth::id();
        $professional->save();

        return $this->respondOk($this->getProfessional($professional->id));
    }

    /**
     * Récupère tous les professionnels.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $professionals = $this->query->where('user_id', Auth::id())->get();

        return $this->respondOk($professionals);
    }

    /**
     * Récupère un professionnel par son ID.
     * @param $id integer Id du professionnel.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $professional = $this->getProfessional($id);

        return $this->respondOk($professional);
    }

    /**
     * Met à jour un professionnel.
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id): JsonResponse
    {
        $professional = $this->getProfessional($id);

        $professional->update($this->request->all());

        return $this->respondOk($this->getProfessional($id));
    }

    /**
     * Supprime un professionnel.
     * @param int $id
     * @return void
     * @throws HttpException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $professional = $this->getProfessional($id);

        $professional->delete();
    }


    /**
     * @param int $id
     * @return Professional
     */
    private function getProfessional(int $id): Professional
    {
        $professional = $this->query->where('user_id', Auth::id())->find($id);

        if ($professional === null) {
            abort(404, 'Ce professionnel n\'existe pas.');
        }

        return $professional;
    }
}
