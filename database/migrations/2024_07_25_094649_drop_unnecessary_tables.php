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
        Schema::dropIfExists('sets');
        Schema::dropIfExists('user_flashcard_progress');
        Schema::dropIfExists('user_flashcard_responses');
        Schema::dropIfExists('results');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('user_flashcard_progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('user_flashcard_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
