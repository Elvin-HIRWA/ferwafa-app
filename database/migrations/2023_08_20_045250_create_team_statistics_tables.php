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
            $table->unsignedBigInteger('gameID');
            $table->unsignedBigInteger('teamID');
            $table->unsignedInteger('goalWin');
            $table->unsignedInteger('goalLoss');
            $table->unsignedInteger('score');
            $table->timestamps();

            $table->foreign('gameID')->references('id')->on('Game')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('teamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');


            


            $table->unique(['gameID', 'teamID'], 'TeamPerDay');
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
