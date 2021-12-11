<?php

namespace Database\Seeders;

use App\Models\EventRequest;
use Illuminate\Database\Seeder;

class EventRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventRequest::factory(100)->create();
    }
}
