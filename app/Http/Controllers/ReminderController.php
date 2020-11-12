<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Request\ReminderValidation;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReminderController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Reminder|Builder
     */
    private $query;

    /**
     * ReminderController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Reminder::relations($this->relations($request));
    }

    /**
     * Créer un nouveau rappel.
     * @return JsonResponse Id du nouveau rappel.
     */
    public function create(): JsonResponse
    {
        $this->validate($this->request, ReminderValidation::rules());

        $reminder = new Reminder($this->request->all());
        $reminder->user_id = Auth::id();
        $reminder->save();

        return $this->respondOk($this->getReminder($reminder->id));
    }

    /**
     * Récupère tous les rappels.
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $reminders = $this->query->where('user_id', Auth::id())->get();

        return $this->respondOk($reminders);
    }

    /**
     * Récupère tous les rappels d'un chien.
     * @param int $dogId
     * @return JsonResponse
     */
    public function getAllByDog(int $dogId): JsonResponse
    {
        $dewormings = $this->query->where('dog_id', $dogId)->get();

        return $this->respondOk($dewormings);
    }

    /**
     * Récupère un rappel par son ID.
     * @param $id integer Id du rappel.
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $reminder = $this->getReminder($id);

        return $this->respondOk($reminder);
    }

    /**
     * Met à jour un rappel.
     * @param int $id
     * @return JsonResponse Rappel modifié.
     */
    public function update(int $id): JsonResponse
    {
        $reminder = $this->getReminder($id);

        $reminder->update($this->request->all());

        return $this->respondOk($this->getReminder($id));
    }

    /**
     * Supprime un rappel.
     * @param int $id
     * @return void
     * @throws HttpException
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $reminder = $this->getReminder($id);

        $reminder->delete();
    }


    /**
     * @param int $id
     * @return Reminder
     */
    private function getReminder(int $id): Reminder
    {
        $reminder = $this->query->find($id);

        if ($reminder === null) {
            abort(404, 'Ce rappel n\'existe pas.');
        }

        return $reminder;
    }
}
