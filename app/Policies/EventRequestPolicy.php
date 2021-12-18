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
        // Allow if the user can manage event requests
        if ($user->can('manage event requests')) {
            return Response::allow();
        }
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

        // Allow if the user can manage event requests
        if ($user->can('manage event requests')) {
            return Response::allow();
        }

        // Allow if the event request is accepted & the request is not hidden
        if ($eventRequest->status === 'accepted' && !$eventRequest->is_hidden) {
            return Response::allow();
        }

        // Otherwise, deny
        return Response::deny('You are not authorized to view this event request.');
    }

    /**
     * Determine whether the user can view the model comments.
     *
     * @param User $user
     * @param EventRequest $eventRequest
     * @return Response
     */
    public function viewComments(User $user, EventRequest $eventRequest): Response
    {
        // Allow if the user requested the event
        if ($eventRequest->requester_id === $user->id) {
            return Response::allow();
        }

        // Allow if the user can manage event requests
        if ($user->can('manage event requests')) {
            return Response::allow();
        }

        // Otherwise, deny
        return Response::deny();
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

    /**
     * Determine whether the user can claim the event request.
     *
     * @param User $user
     * @param EventRequest $eventRequest
     * @return Response
     */
    public function claim(User $user, EventRequest $eventRequest): Response
    {
        // Allow if the user can manage event requests
        if ($user->can('manage event requests')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to claim this event request.');
    }

    /**
     * Determine whether the user can update the event request.
     *
     * @param User $user
     * @param EventRequest $eventRequest
     * @return Response
     */
    public function update(User $user, EventRequest $eventRequest): Response
    {
        // Check if the event request is handled
        if ($eventRequest->isHandled()) {
            return Response::deny('You cannot update a handled application.');
        }

        // Allow if the user can manage event requests
        if ($user->can('manage event requests')) {
            return Response::allow();
        }

        return Response::deny('You do not have permission to edit this event request.');
    }

    /**
     * Determine whether the user can comment on the event request.
     *
     * @param User $user
     * @param EventRequest $eventRequest
     * @return Response
     */
    public function comment(User $user, EventRequest $eventRequest): Response
    {
        // Deny if the event request is accepted
        if ($eventRequest->status === 'accepted') {
            return Response::deny('You cannot comment on an accepted event request.');
        }

        // Allow if the user requested the event
        if ($eventRequest->requester_id === $user->id) {
            return Response::allow();
        }

        // Deny if the user cannot manage event requests
        if ($user->cannot('manage event requests')) {
            return Response::deny('You do not have permission to comment on this event request.');
        }

        // Deny if the user hasn't claimed the application
        if ($user->id !== $eventRequest->staff_id) {
            return Response::deny('You must claim this application before you can comment on it.');
        }

        return Response::allow();
    }
}
