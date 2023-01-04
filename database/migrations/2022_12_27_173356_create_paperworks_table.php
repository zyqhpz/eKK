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
        Schema::create('paperworks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('isGenerated');
            $table->string('filePath')->nullable();
            $table->integer('clubId');
            $table->integer('paperworkDetailsId');
            $table->timestamps();
            $table->int('isOneDay')->nullable();
            $table->date('programDate')->nullable();
            $table->string('venue')->nullable();
            $table->string('status')->nullable();
            $table->string('progressStates')->nullable();
            $table->int('currentProgressState')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paperworks');
    }
};
