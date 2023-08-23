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
            $table->unsignedBigInteger('teamID')->unique();
            $table->unsignedInteger('goalWin');
            $table->unsignedInteger('goalLoss');
            $table->integer('goalDifference');
            $table->unsignedInteger('matchPlayed');
            $table->unsignedInteger('score');
            $table->timestamps();


            $table->foreign('teamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
