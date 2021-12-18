<?php

namespace App\Actions\EventRequest;

use App\Models\EventRequest;
use Throwable;

class UpdateEventRequestStatus
{
    /**
     * @param EventRequest $eventRequest
     * @param string $status
     * @return EventRequest
     * @throws Throwable
     */
    public function execute(EventRequest $eventRequest, string $status): EventRequest
    {
        // Update the event request status
        $eventRequest->updateOrFail([
            'status' => $status,
        ]);

        // Perform any status-specific actions
        match ($status) {
            default => null, // Do nothing if the above statuses don't match
        };

        return $eventRequest->fresh();
    }
}
