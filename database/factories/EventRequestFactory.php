<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class EventRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        // Generate a random start datetime between tomorrow and 364 days from now
        $start_at = Carbon::today()->addDays(random_int(1, 364));
        // Generate a random end date 4 hours after the start datetime
        $end_at = $start_at->copy()->addHours(4);

        $games = [
            'ETS2',
            'ATS',
        ];

        return [
            'requester_id' => User::factory()->create()->id,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'name' => $this->faker->words(3, true),
            'event_link' => $this->faker->url,
            'description' => $this->faker->markdown(),
            'rules' => $this->faker->markdown(),
            'header_image_path' => $this->generateHeaderImage(),
            'comment' => $this->faker->sentences(3, true),
            'is_hidden' => (bool)mt_rand(0, 1),
            'server_name' => $this->faker->words(2, true),
            'game' => $games[array_rand($games)],
            'max_players' => mt_rand(100, 600),
            'enable_afk_kick' => (bool)mt_rand(0, 1),
            'enable_speed_limit' => (bool)mt_rand(0, 1),
            'enable_player_collisions' => (bool)mt_rand(0, 1),
            'enable_cars_for_players' => (bool)mt_rand(0, 1),
            'enable_live_map' => (bool)mt_rand(0, 1),
            'enable_promods' => (bool)mt_rand(0, 1),
        ];
    }

    private function generateHeaderImage(): string
    {
        $logoPath = storage_path('app/public/images/event-requests');

        // Create the path(s) if they don't exist yet
        if (!File::exists($logoPath)) {
            File::makeDirectory($logoPath, 0755, true);
        }

        // Generate a random image, and store it
        $logo = $this->faker->image($logoPath, 1920, 500, null, false);

        // Return the asset path
        return "storage/images/event-requests/$logo";
    }
}
