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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_reserva');
            $table->string('rut_o_pasaporte');
            $table->string('nombre');
            $table->string('correo', 320);
            $table->string('fono');
            $table->text('info_adicional')->nullable();
            $table->integer('total_noches');
            $table->integer('total_precio');
        });
        Schema::create('stays', function (Blueprint $table) {
            $table->unsignedBigInteger('reserva');
            $table->unsignedBigInteger('habitacion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
        
            $table->primary(['reserva', 'habitacion']);
            $table->unique(['reserva', 'habitacion', 'fecha_inicio', 'fecha_fin']);
            
            $table->foreign('reserva')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('habitacion')->references('id')->on('rooms')->onDelete('cascade');
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva');
            $table->integer('monto');
            $table->string('tipo_pago');
            $table->string('estado');
            $table->date('fecha_pago');

            $table->foreign('reserva')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('stays');
        Schema::dropIfExists('reservations');
    }
};
