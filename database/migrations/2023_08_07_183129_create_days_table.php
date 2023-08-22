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
        Schema::create('Day', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Day1 up to Day30
            $table->string('abbreviation');
            $table->unsignedBigInteger('seasonID');
            $table->timestamps();


            $table->foreign('seasonID')->references('id')->on('Season')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Day');
    }
};
