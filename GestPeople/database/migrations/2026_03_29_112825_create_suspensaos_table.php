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
        Schema::create('suspensaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //Id do usuário
            $table->boolean('efectivo')->default(true); //É efectivo
            $table->boolean('suspenso')->default(false); //É efectivo mas está suspenso
            $table->boolean('demitido')->default(false); //Demitido
            $table->date('inicio')->nullable(); //Início da suspensão
            $table->date('fim')->nullable(); //Fim da suspensão
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspensaos');
    }
};
