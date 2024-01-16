<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->datetime('answer_text_01');
            $table->datetime('answer_text_02');
            $table->datetime('answer_text_03');
            $table->datetime('answer_text_04');
            $table->datetime('answer_text_05');
            $table->datetime('answer_text_06');
            $table->datetime('answer_text_07');
            $table->datetime('answer_text_08');
            $table->datetime('answer_text_09');
            $table->datetime('answer_text_10');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
