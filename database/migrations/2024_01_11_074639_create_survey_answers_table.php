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
            $table->datetime('answered_at');
            $table->text('answer_text_01');
            $table->text('answer_text_02');
            $table->text('answer_text_03');
            $table->text('answer_text_04');
            $table->text('answer_text_05');
            $table->text('answer_text_06');
            $table->text('answer_text_07');
            $table->text('answer_text_08');
            $table->text('answer_text_09');
            $table->text('answer_text_10');
            $table->timestamps();
            $table->softDeletes();
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
