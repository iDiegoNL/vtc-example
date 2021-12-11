<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')
                ->constrained('users')
                ->cascadeOnUpdate(); // Update the primary key if changed
            $table->foreignId('staff_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate(); // Update the primary key if changed
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('name');
            $table->string('event_link');
            $table->longText('description');
            $table->longText('rules');
            $table->string('header_image_path');
            $table->longText('comment')->nullable();
            $table->boolean('is_hidden');
            $table->string('server_name');
            $table->string('game');
            $table->integer('max_players');
            $table->boolean('enable_afk_kick');
            $table->boolean('enable_speed_limit');
            $table->boolean('enable_player_collisions');
            $table->boolean('enable_cars_for_players');
            $table->boolean('enable_live_map');
            $table->boolean('enable_promods');
            $table->enum('status', ['new', 'accepted', 'declined'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_requests');
    }
}
