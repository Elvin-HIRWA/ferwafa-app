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
        Schema::create('TeamInSeason', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teamID');
            $table->unsignedBigInteger('seasonID');
            $table->unsignedBigInteger('divisionID');
            $table->timestamps();


            $table->foreign('teamID')->references('id')->on('Team')
                ->onDelete('restrict')
                ->onUpdate('cascade');


            $table->foreign('seasonID')->references('id')->on('Season')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('divisionID')->references('id')->on('Division')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TeamInSeason');
    }
};
