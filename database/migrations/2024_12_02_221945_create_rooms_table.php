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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('precio');
        });
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo');
            $table->integer('precio');
            $table->boolean('banopriv');
            $table->boolean('television');
            $table->boolean('aireac');
            $table->text('descripcion');
            $table->integer('piso');
            $table->boolean('disponible');
            $table->json('urlfoto');

            $table->foreign('tipo')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('services');
        Schema::dropIfExists('types');
    }
};