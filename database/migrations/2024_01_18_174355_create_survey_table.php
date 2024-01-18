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
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->text('survey_text_01');
            $table->text('survey_text_02');
            $table->text('survey_text_03');
            $table->text('survey_text_04');
            $table->text('survey_text_05');
            $table->text('survey_text_06');
            $table->text('survey_text_07');
            $table->text('survey_text_08');
            $table->text('survey_text_09');
            $table->text('survey_text_10');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
