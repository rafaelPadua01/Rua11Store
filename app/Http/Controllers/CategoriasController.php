<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
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
        $categorias = Categorias::all();
        return Inertia::render('Categorias/categoriasComponent', [
            'user' => $user,
            'categorias' => $categorias,
        ]);
    }
    public function create()
    {
        $user = \Auth::user();
       
        return Inertia::render('Categorias/createComponent',[
            'user' => $user,
            
        ]);
    }
    public function store(Request $request)
    {
        $user = \Auth::user();
        $data = $request->all();
       
        try{
            $store = Categorias::create([
                'user_id' => $user->id,
                'nome_categoria' => $request->nome_categoria,
            ]);
            $response = true;
            return Inertia::render('Categorias/createComponent');
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }

    }
    public function show($id)
    {
        $categoria = Categorias::findOrFail($id);
        
        if($categoria)
        {
            return Inertia::render('Categorias/updateComponent',
            [
                'categoria' => $categoria,
            ]);
        }
        else{
            return false;
        }
    }
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $categorias = Categorias::all();
        try{
            $categoria = Categorias::findOrFail($id)->where('id', '=', $id)->update([
                'nome_categoria' => $request->nome_categoria,
            ]);
            $response = true;
            
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
    public function remove($id)
    {
        $categoria = Categorias::findOrFail($id);
        return Inertia::render('Categorias/removeComponent', [
            'categoria' => $categoria,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $categoria = Categorias::findOrFail($id);
       
        try{
            $delete = Categorias::where('id', '=', $id)->delete();
     
            $response = true;
           
        }
        catch(Exception $e)
        {
            $error = $e;
            $categorias = $categorias::all();
            return Inertia::render('Categorias/categoriasComponent', ['categorias' => $categorias]);
        }
        
    }

}