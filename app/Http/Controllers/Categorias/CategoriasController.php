<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Requests\Request;
use App\Models\Categorias;

class CategoriasController extends Controller
{
    private $categoria;

    public function __construct(Categorias $categoria)
    {
        $this->categoria = $categoria;
    }

    public function index()
    {
        $user = \Auth::user();
        //$categorias = Categorias::all();
        return Inertia::render('Categorias/categoriasComponent', [
            'user' => $user,
           // 'categorias' => $categorias,
        ]);
    }
}