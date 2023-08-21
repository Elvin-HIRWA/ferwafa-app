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
            $table->unsignedInteger('homeTeamGoals')->nullable();
            $table->unsignedInteger('awayTeamGoals')->nullable();
            $table->timestamp('date');
            $table->timestamp('startTime');
            $table->timestamps();
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
