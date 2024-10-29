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
        Schema::table('flashcards', function (Blueprint $table) {
            // Vérifiez chaque colonne avant de l'ajouter
            if (!Schema::hasColumn('flashcards', 'option1')) {
                $table->string('option1')->after('question');
            }
            if (!Schema::hasColumn('flashcards', 'option2')) {
                $table->string('option2')->after('option1');
            }
            if (!Schema::hasColumn('flashcards', 'option3')) {
                $table->string('option3')->after('option2');
            }
            if (!Schema::hasColumn('flashcards', 'option4')) {
                $table->string('option4')->after('option3');
            }
            if (!Schema::hasColumn('flashcards', 'correct_answer')) {
                $table->string('correct_answer')->after('option4');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flashcards', function (Blueprint $table) {
            $table->dropColumn(['option1', 'option2', 'option3', 'option4', 'correct_answer']);
        });
    }
};
