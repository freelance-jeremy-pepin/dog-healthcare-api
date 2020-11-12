<?php

namespace App\Http\Controllers;

use App\Models\TimeInterval;
use App\Request\TimeIntervalValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TimeIntervalController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var TimeInterval|Builder
     */
    private $query;

    /**
     * TimeIntervalController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = TimeInterval::relations($this->relations($request));
    }

    /**
     * Récupère tous les intervalles de temps.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $timeIntervals = $this->query->get();

        return $this->respondOk($timeIntervals);
    }

    /**
     * Récupère un intervalle de temps par son ID.
     * @param $id integer Id de l'intervalle de temps.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $timeInterval = $this->getTimeInterval($id);

        return $this->respondOk($timeInterval);
    }

    /**
     * @param int $id
     * @return TimeInterval
     */
    private function getTimeInterval(int $id): TimeInterval
    {
        $timeInterval = $this->query->find($id);

        if ($timeInterval === null) {
            abort(404, 'Cet intervalle de temps n\'existe pas.');
        }

        return $timeInterval;
    }
}
