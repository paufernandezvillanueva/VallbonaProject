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
        Schema::create('empreses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cif')->unique();
            $table->string('name');
            $table->string('sector');
            $table->unsignedBigInteger('poblacio_id');

            $table->foreign('poblacio_id')->references('id')->on('poblacions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empreses');
    }
};
