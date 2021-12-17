<?php

namespace App\Policies;

use App\Models\EventRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EventRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param EventRequest $eventRequest
     * @return Response
     */
    public function view(User $user, EventRequest $eventRequest): Response
    {
        // Allow if the user requested the event
        if ($eventRequest->requester_id === $user->id) {
            return Response::allow();
        }

        // TODO: Allow if the user can manage event requests

        // Allow if the event request is accepted
        if ($eventRequest->status === 'accepted') {
            return Response::allow();
        }

        // Otherwise, deny
        return Response::deny('You are not authorized to view this event request.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }
}
