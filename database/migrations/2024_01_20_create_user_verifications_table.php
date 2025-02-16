<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('verification_level_id')->constrained();
            $table->integer('points')->default(0);
            $table->json('completed_steps')->nullable(); // Passos de verificação completados
            $table->json('verification_history')->nullable(); // Histórico de mudanças de nível
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_verifications');
    }
}; 