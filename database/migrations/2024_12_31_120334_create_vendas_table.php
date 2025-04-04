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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuarioId'); 
            $table->foreign('usuarioId')->references('id')->on('usuarios')->onDelete('cascade');
            $table->decimal('precoTotal', 10, 2); 
            $table->string('formaPagamento'); 
            $table->string('status')->default('pendente'); 
            $table->dateTime('dataVenda'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
