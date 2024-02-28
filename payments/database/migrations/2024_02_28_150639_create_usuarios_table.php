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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipo');
            $table->string('nome_completo',100);
            $table->string('cpf',11)->unique();
            $table->string('email')->unique();
            $table->string('senha');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tipo')->references('id')->on('tipo_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
