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
        Schema::create('survey_details', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_id');
            $table->integer('survey_item_id');
            $table->integer('state')->nullable();
            $table->text('content');
            $table->integer('type');
            $table->integer('order');
            $table->text('choices')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_details');
    }
};
