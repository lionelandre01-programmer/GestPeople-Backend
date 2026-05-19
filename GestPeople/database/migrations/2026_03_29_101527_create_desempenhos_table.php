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
        Schema::create('desempenhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //O id do usuário
            $table->integer('nivel'); //Nível do desempenho quanto as actividades bem sucedidas
            $table->boolean('liquidado')->default(false); //Desempenho processados no salário
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desempenhos');
    }
};
