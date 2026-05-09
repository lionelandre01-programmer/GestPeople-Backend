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
        Schema::create('messeges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id'); //O emissor
            $table->unsignedBigInteger('to_user_id'); //O receptor
            $table->text('body'); //A mensagem
            $table->boolean('delete')->default(false); //Retorna true quando o usuário apaga a mensagem
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messeges');
    }
};
