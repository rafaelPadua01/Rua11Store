<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_produto', 'nome_cliente', 'endereco_cliente', 'forma_pagamento', 'nome_produto', 'quantidade', 'preco'];

    protected $cast = [
        'id_produto' => asArrayObject::class,
        'nome_produto' => asArrayObject::class,
        'quantidade' => asArrayObject::class,
        'preco' => asArrayObject::class,
    ];
}
