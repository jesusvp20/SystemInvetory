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
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('IdProducto');
            $table->string('nombre', 250);
            $table->text('descripcion');
            $table->decimal('precio', 14, 2);
            $table->integer('cantidad_disponible');
            $table->string('categoria', 50);
            $table->unsignedBigInteger('proveedor');
            $table->string('codigoProducto', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->foreign('proveedor')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};