<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    use HasFactory;
    protected $fillable = ['nome_subcategoria', 'nome_categoria', 'categoria_id', 'user_id'];
}
