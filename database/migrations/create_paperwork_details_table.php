<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paperwork_details', function (Blueprint $table) {
            $table->id();
            $table->string('introduction')->nullable();
            $table->text('background')->nullable();
            $table->text('objective')->nullable();
            $table->string('learningOutcome')->nullable();
            $table->string('theme')->nullable();
            $table->string('organizedBy')->nullable();
            $table->string('targetGroup')->nullable();
            $table->string('dateVenueTime')->nullable();
            $table->text('tentative')->nullable();
            $table->text('financialImplication')->nullable();
            $table->text('programCommittee')->nullable();
            $table->string('closing')->nullable();
            $table->text('signature')->nullable();
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
        Schema::dropIfExists('paperwork_details');
    }
};
