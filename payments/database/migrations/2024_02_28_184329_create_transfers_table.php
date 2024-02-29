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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_state');
            $table->unsignedBigInteger('payer');
            $table->unsignedBigInteger('payee');
            $table->integer('value');
            $table->timestamps();
            
            $table->foreign('id_state')->references('id')->on('state_transfers');
            $table->foreign('payer')->references('id')->on('wallets');
            $table->foreign('payee')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
