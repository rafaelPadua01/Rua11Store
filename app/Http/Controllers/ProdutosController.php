<?php
namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class ProdutosController extends Controller
{
    private $produtos;

    public function __construct(Produtos $produtos)
    {
        $this->produtos = $produtos;
    }

    public function index()
    {
        $all_produtos = Produtos::all(); 
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        return Inertia::render('Produtos/produtosComponent',[
            'produtos' => $all_produtos,    
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
        ]);
    }
    public function create()
    {
        $user = \Auth::user();
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        return Inertia::render('Produtos/createComponent',[
            'user' => $user,
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $produto_imagem = $request->file('file');
        $produto_imagem_name = $request->file('file')->getClientOriginalName();
        $produto_imagem_extension = $produto_imagem->extension();
        $nome_imagem = 'produto.'.$produto_imagem_name;
        $user = \Auth::user();
        
        #$categoria = Categorias::findOrFail($request->id_categoria);
        #$subcategoria = Subcategorias::findOrFail($request->id_subcategoria);
       
        try{

            $upload_file = $request->file('file')->move('storage/produtos/', $nome_imagem, $nome_imagem);
            $path_file = $upload_file;
            $status = $request->status;
            if($status)
            {
                $status = 'disponível';
                $insert_data = Produtos::create([
                    'nome_produto' => $request->nome_produto,
                    'imagem_produto' => $path_file,
                    'status' => $status,
                    'quantidade' => $request->quantidade,
                    'preco' => $request->preco,
                    'descricao' => $request->descricao,
                    'id_categoria' => $request->id_categoria,
                    'id_subcategoria' => $request->id_subcategoria,
                    'user_id' => $user->id,
                ]);
                return Inertia::render('Produtos/produtosComponent');
            }
            else
            {
                $status = 'indisponível';
                $insert_data = Produtos::create([
                    'nome_produto' => $request->nome_produto,
                    'imagem_produto' => $path_file,
                    'status' => $status,
                    'quantidade' => $request->quantidade,
                    'preco' => $request->preco,
                    'descricao' => $request->descricao,
                    'categoria_id' => $request->id_categoria,
                    'subcategoria_id' => $request->id_subcategoria,
                    'user_id' => $user->id,
                ]);
                return Inertia::render('Produtos/produtosComponent');

            }
            return Inertia::render('Produtos/produtosComponent');     
            
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
    public function show($id)
    {
        $produto = Produtos::findOrFail($id);
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        return Inertia::render('Produtos/showComponent',[
            'produto' => $produto,
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
        ]);
    }
    public function update(Request $request, $id)
    {
        $produto = Produtos::findOrFail($id);
        $data = $request->all();
        $status = $request->status;
        $produto_imagem = Storage::delete('storage/produtos', $produto->imagem_produto);
        $imagem_nome = $request->file('imagem_produto')->getClientOriginalName();
        $n_imagem_nome = 'produto'.$imagem_nome;
        $n_produto_imagem = $request->file('imagem_produto')->move('storage/produtos', $n_imagem_nome);
        $path_file = $n_produto_imagem;
       
       
        try{
            //$update_register = Produtos::where('id', '=', $id)->update($data);
            if($status){
                $status = 'disponível';

            $update_produto = Produtos::where('id', '=', $id)->update([
                'id_categoria' => $request->id_categoria,
                'id_subcategoria' => $request->id_subcategoria,
                'nome_produto' => $request->nome_produto,
                'imagem_produto' => $path_file,
                'preco' => $request->preco,
                'quantidade' => $request->quantidade,
                'descricao' => $request->descricao,
                'status' => $status,

            ]);

            $response = true;
            return Inertia::render('Produtos/produtosComponent');

            }
            else{
                $status = 'Indisponivel';

            $update_produto = Produtos::where('id', '=', $id)->update([
                'id_categoria' => $request->id_categoria,
                'id_subcategoria' => $request->id_subcategoria,
                'nome_produto' => $request->nome_produto,
                'imagem_produto' => $path_file,
                'preco' => $request->preco,
                'quantidade' => $request->quantidade,
                'descricao' => $request->descricao,
                'status' => $status,

            ]);

            $response = true;
            return Inertia::render('Produtos/produtosComponent');
            }

            
            
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
   public function add($id)
    {
        $produto = Produtos::findOrFail($id);
        return Inertia::render('Produtos/addComponent',[
            'produto' => $produto,
        ]);
    }
    public function include(Request $request, $id)
    {
        $produto = Produtos::findOrFail($id);
        $data = $request->all();
        $soma = 0;
        $soma += $produto->quantidade + $request->quantidade;
        try{
            $include  = Produtos::select('quantidade')->where('id', '=', $id)->update(['quantidade' => $soma]);
            if($include)
            {
                $response = true;
                return \Response::json($response);
            }
            else
            {
                $error = 0;
                return \Response::json($error);
            }
        } 
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);

        }
    }
    public function remove($id)
    {
        $produto = Produtos::findOrFail($id);
        return Inertia::render('Produtos/removeComponent', [
            'produto' => $produto,
        ]);
    }
    public function destroy($id)
    {
        $produto = Produtos::findOrFail($id);
        
            if($produto)
            {

                try{
                    $dir_remove = Storage::delete('storage/produtos', $produto->imagem_produto, $produto->imagem_produto);
                    $delete_produto = Produtos::findOrFail($id)->delete();
                    $response = true;
                    return \Response::json($response);
                    
                }
                catch(Exception $e)
                {
                    $error = $e;
                    return \Response::json($error);
                }
            }
            else{
                $error = false;
                return \Response::json($error);
            }
    }
    
       
}