<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_produto');
            $table->Biginteger('quantidade');
            $table->boolean('preco');
            $table->string('imagem_produto');
            #$table->BigInteger('referencia');
            $table->longText('descricao');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
