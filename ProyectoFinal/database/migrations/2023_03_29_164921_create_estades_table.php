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
        Schema::create('estadas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('student_name');
            $table->unsignedBigInteger('cicle_id');
            $table->unsignedBigInteger('empresa_id');
            $table->integer('evaluation');
            $table->string('comment')->nullable();
            $table->boolean('dual');
            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('curs_id');

            $table->foreign('cicle_id')->references('id')->on('cicles');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('curs_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadas');
    }
};
