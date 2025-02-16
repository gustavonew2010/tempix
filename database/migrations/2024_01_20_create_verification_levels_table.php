<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('verification_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // bronze, silver, gold
            $table->string('slug')->unique();    // bronze, silver, gold
            $table->string('color_hex');         // Cor do nível para UI
            $table->text('description');         // Descrição do nível
            $table->decimal('withdrawal_limit', 10, 2); // Limite de saque
            $table->json('requirements');        // Requisitos para atingir o nível
            $table->integer('points_required');  // Pontos necessários para o nível
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verification_levels');
    }
}; 