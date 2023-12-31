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
        Schema::create('Game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homeTeamID');
            $table->unsignedBigInteger('awayTeamID');
            $table->unsignedBigInteger('dayID');
            $table->string('stadeName');
            $table->unsignedInteger('homeTeamGoals');
            $table->unsignedInteger('awayTeamGoals');
            $table->timestamp('date');
            $table->boolean('isPlayed')->default(false);
            $table->timestamps();


            $table->foreign('homeTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('awayTeamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('dayID')->references('id')->on('Day')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unique(['homeTeamID', 'dayID'], 'homeTeamPerDay');
            $table->unique(['awayTeamID', 'dayID'], 'awayteamPerDay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Game');
    }
};
