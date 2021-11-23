<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')
                ->constrained('users')
                ->cascadeOnUpdate() // Update the primary key if changed
                ->cascadeOnDelete(); // Delete the company if the user is deleted
            $table->string('name');
            $table->string('tag');
            $table->string('slogan');
            $table->string('website_url')->nullable();
            $table->string('contact_email');
            $table->boolean('recruitment_open');
            $table->string('logo_path');
            $table->boolean('logo_border');
            $table->string('cover_image_path')->nullable();
            $table->longText('information');
            $table->longText('rules');
            $table->longText('requirements');
            $table->boolean('display_members');
            $table->boolean('show_tag');
            $table->boolean('hide_email');
            $table->boolean('receive_emails');
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
        Schema::dropIfExists('companies');
    }
}
