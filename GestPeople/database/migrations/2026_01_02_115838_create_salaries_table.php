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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->decimal('salario', 10, 2); //Salario Base
            $table->float('transporte'); //Subsídio de transporte (Em percentagem)
            $table->float('alimentacao'); //Subsídio de alimentação (Em percentagem)
            $table->float('desempenho'); //Subsídio de desempenho (Em percentagem)
            $table->float('presenca'); //Subsídio de presença (Em percentagem)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
