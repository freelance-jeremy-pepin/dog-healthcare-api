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
     * @return int Id du nouveau vermifuge.
     */
    public function create(): int
    {
        $this->validate($this->request, DewormingValidation::rules());

        $deworming = new Deworming($this->request->all());
        $deworming->save();

        return $deworming->id;
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
     * Met à jour un vermifuge.
     * @param int $id
     * @return void
     * @throws HttpException
     */
    public function update(int $id): void
    {
        $deworming = $this->getDeworming($id);

        $deworming->update($this->request->all());
    }

    /**
     * Supprime un vermifuge.
     * @param int $id
     * @return void
     * @throws HttpException
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
