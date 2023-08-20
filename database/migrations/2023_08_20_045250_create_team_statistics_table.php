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
        Schema::create('TeamStatistic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teamID');
            $table->unsignedInteger('goalWin');
            $table->unsignedInteger('goalLoss');
            $table->unsignedInteger('goalDifference');
            $table->unsignedInteger('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamStatistic');
    }
};
