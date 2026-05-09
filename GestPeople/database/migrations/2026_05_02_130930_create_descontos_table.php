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
        Schema::create('descontos', function (Blueprint $table) {
            $table->id();
            $table->float('faltas')->nullable(); //Percentagem de desconto por faltas
            $table->float('justicadas')->nullable(); //Percentagem de desconto por faltas justificadas
            $table->float('atrasos')->nullable(); //Percentagem de desconto por atraso
            $table->float('desempenho')->nullable(); //Percentagem de desconto por mal desempenho
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descontos');
    }
};
