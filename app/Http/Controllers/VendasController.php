<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vendas;
use App\Models\Produtos;
use Symfony\Component\Console\Input\Input;

class VendasController extends Controller
{
    public function __construct(Vendas $vendas)
    {
        $this->vendas = $vendas;
    }
    public function index()
    {
        $produtos = Produtos::all();
        $vendas = Vendas::all();
        return Inertia::render('Vendas/vendasComponent.vue', [
            'produtos' => $produtos,
            'vendas' => $vendas,
        ]);

    }
    public function store(Request $request)
    {
        $user_auth = \Auth::user();
        //insere e cria o usuario (cliente que fez a compra)
        $data = $request->all();
        $count = $data;
       
        if($count > 0){
            for($i = 0 ; $i <= sizeOf($count); $i++)
            {
                foreach((array) $request->all('id') as $produto){
                    $dataProdutos[] = Vendas::create([
                        'id_user' => $user_auth->id,
                        'id_produto' => $count[$i]['id'],
                        'nome_cliente' => $request->nome_cliente,
                        'endereco_cliente' => $request->endereco_cliente,
                        'forma_pagamento' => $request->forma_pagamento,
                        'nome_produto' => $count[$i]['nome_produto'],
                        'quantidade' => $count[$i]['quantidade'],
                        'preco' => $count[$i]['preco'], 
        
                    ]);
                           
                    $produtos = Produtos::findOrFail($count[$i]['id']);
                    $quantidade = $produtos->quantidade; 
                    $reduz = $quantidade - $count[$i]['quantidade'];
                    $update_quantidade  = Produtos::where('id', '=', $count[$i]['id'])
                                                    ->update(['quantidade' => $reduz]);
                }
               
            }
            if($update_quantidade)
            {
                    $response = true;
                    return \Response::json($response); 
            }
             else{
                $error = false;
                return \Response::json($error);
            }
        }

    }
    public function destroy($id)
    {
        try
        {
            $remove_venda = Vendas::findOrFail($id)->where('id', '=', $id)->delete();
            $response = true;
            return \Response::json($response);
            

        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
    }
    public function destroyAll(Request $request)
    {
        $allData = $request->all();
        $count = $allData;
        try{
            if($count >= 1)
            {
                for($i = 0; $i <= sizeOf($count); $i++)
                {
                    foreach((array) $request->all('id') as $data)
                    {
                            $remove_vendas[] = Vendas::whereIn('id', explode(',', $count[$i]['id']))->delete();
                    
                    }
                }
                $response = true;
                return \Response::json($response);
            }
            else
            {
                $erro = false;
                return \Response::json($error);
            }
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
       
    }
       
       
        
        
    
}
