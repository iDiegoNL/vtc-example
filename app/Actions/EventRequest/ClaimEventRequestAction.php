<?php

namespace App\Actions\EventRequest;

use App\Models\EventRequest;
use App\Models\User;

class ClaimEventRequestAction
{
    /**
     * @param EventRequest $eventRequest
     * @param User $user
     * @return EventRequest
     */
    public function execute(EventRequest $eventRequest, User $user): EventRequest
    {
        // Associate the (staff) user with the event request
        $eventRequest->staff()->associate($user);

        // Save the event request
        $eventRequest->save();

        return $eventRequest->fresh();
    }
}
