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
        Schema::create('News', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('caption');
            $table->text('description');
            $table->unsignedBigInteger('statusID');
            $table->boolean('is_top')->default(false);
            $table->timestamps();


            $table->foreign('statusID')->references('id')->on('Status')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('News');
    }
};
