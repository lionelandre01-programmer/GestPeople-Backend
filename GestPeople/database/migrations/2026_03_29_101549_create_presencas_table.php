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
        Schema::create('presencas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //Id do usuário
            $table->time('entrada')->nullable(); //Hora de entrada
            $table->time('saida')->nullable(); //Hora de saída
            $table->enum('status',['presente','ausente','atrasado']); //Status do dia
            $table->boolean('justificada')->default(false); //True caso tenha faltado e justificado
            $table->text('justificativa')->nullable(); //O motivo da falta
            $table->boolean('liquidado')->default(false); //Já usados no pagamento
            $table->date('data'); //Data em que o usuário faltou
            $table->timestamps();
            $table->unique(['user_id','data']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
