<?php

namespace App\Http\Controllers;

use App\Models\Subcategorias;
use App\Models\User;
use App\Models\Categorias;  
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SubcategoriasController extends Controller
{
    private $subcategorias;

    public function __construct(Subcategorias $subcategorias)
    {
        $this->subcategorias = $subcategorias;
    }

    public function index()
    {
        $subcategorias = Subcategorias::all();
        $categorias = Categorias::all();
        return Inertia::render('Subcategorias/subcategoriasComponent', [
            'subcategorias' => $subcategorias,
            'categorias' => $categorias,
        ]);
    }
    public function create()
    {
        $user = \Auth::user();
        $categorias = Categorias::all();
        return Inertia::render('Subcategorias/createComponent', [
            'categorias' => $categorias,
        ]);    
    }
    public function store(Request $request)
    {
        $data = $request->all();
       
        $user = \Auth::user();
        //$categoria = Categorias::findOrFail($id);
        try{
    
            $insert_data = Subcategorias::create([
                'nome_subcategoria' => $request->nome_subcategoria,
                'user_id' => $user->id,
                'categoria_id' => $request->id_categoria,
            ]); 
            $response = true;
            return \Response::json($response);
        }
        catch(Exception $e)
        {
            $erro = $e;
            return \Response::json($error);
        }
    }
    public function show($id)
    {
        $subcategoria = Subcategorias::findOrFail($id);
        $categorias = Categorias::all();
        return Inertia::render('Subcategorias/updateComponent', [
            'subcategoria' => $subcategoria,
            'categorias' => $categorias,
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $subcategoria = Subcategorias::findOrFail($id);
        
        try{
            $update_data = Subcategorias::where('id', '=', $id)->update([
                'nome_subcategoria' => $request->nome_subcategoria,
                'categoria_id' => $request->categoria_id,
            ]);
            $response = true;
            return \Response::json($response);
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
    public function remove($id)
    {
        $subcategoria = Subcategorias::findOrFail($id);
        return Inertia::render('Subcategorias/removeComponent',[
            'subcategoria' => $subcategoria,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $subcategoria = Subcategorias::findOrFail($id);
        try{
            $destroy_data = Subcategorias::where('id', '=', $id)->delete();
            $response = true;
            return $response;
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }
}