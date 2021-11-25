<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')
                ->constrained('users')
                ->cascadeOnUpdate() // Update the primary key if changed
                ->cascadeOnDelete(); // Delete the application if the user is deleted
            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnUpdate() // Update the primary key if changed
                ->cascadeOnDelete(); // Delete the application if the company is deleted
            $table->foreignId('staff_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate(); // Update the primary key if changed
            $table->longText('description');
            $table->enum('status', ['new', 'in progress', 'hired', 'declined', 'left', 'cancelled', 'fired'])->default('new');
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
        Schema::dropIfExists('company_applications');
    }
}
