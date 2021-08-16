<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_produto');
            $table->string('nome_cliente');
            $table->string('endereco_cliente');
            $table->string('forma_pagamento');
            $table->text('nome_produto');
            $table->text('quantidade');
            $table->text('preco');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
