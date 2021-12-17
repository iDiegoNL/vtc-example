<?php

namespace App\Actions\EventRequest;

use App\Http\Requests\StoreEventRequestRequest;
use App\Models\EventRequest;
use App\Models\User;

class CreateEventRequestAction
{
    /**
     * @param User $user
     * @param StoreEventRequestRequest $data
     * @return EventRequest
     */
    public function execute(User $user, StoreEventRequestRequest $request): EventRequest
    {
        $data = $request->validated();

        // Store the header image
        $headerImage = $request->file('header_image')->store('images/event-requests', 'public');

        // Create a new event request for the user
        return $user->eventRequests()->create([
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'name' => $data['name'],
            'event_link' => $data['event_link'],
            'description' => $data['info'],
            'rules' => $data['rules'],
            'header_image_path' => "storage/{$headerImage}",
            'comment' => $data['comment'],
            'is_hidden' => $data['hide'] ?? false,
            'server_name' => $data['server_name'],
            'game' => $data['game'],
            'max_players' => $data['max_players'],
            'enable_speed_limit' => $data['speedlimiter'] ?? false,
            'enable_afk_kick' => $data['afk'] ?? false,
            'enable_player_collisions' => $data['collisions'] ?? false,
            'enable_cars_for_players' => $data['cars_for_players'] ?? false,
            'enable_live_map' => $data['map'] ?? false,
            'enable_promods' => $data['promods'] ?? false,
        ]);
    }
}
