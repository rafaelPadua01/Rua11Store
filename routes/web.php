<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
USE App\Events\Chat\RealtimeMessage;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReplyMessageController;
use App\Http\Controllers\NavigationBarController;    
use App\Models\HomePage;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Produtos;
use App\Models\Vendas;
use App\Models\Message;
use App\Models\ReplyMessage;
use App\Http\Middleware\CheckVisitor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomePageController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $categorias = Categorias::all();
    $user_auth = \Auth::user();
    $vendas = Vendas::all();
   // RealtimeMessage::dispatch();
    return Inertia\Inertia::render('Dashboard', [
        'categorias' => $categorias,
        'users' => $user_auth,
        'vendas' => $vendas,
    ]);
})->name('dashboard');

//Rotas Navbar
Route::get('/navigationbar', [NavigationBarController::class, 'users'])->name('navigationbar')->middleware('auth');
Route::get('/navigationbar/messages', [NavigationBarController::class, 'messages'])->name('messages')->middleware('auth');

Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias')->middleware('auth');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('create')->middleware('auth');
Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('store')->middleware('auth');
Route::get('/categorias/show/{id}', [CategoriasController::class, 'show'])->name('show')->middleware('auth');
Route::post('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('update')->middleware('auth');
Route::get('/categorias/remove/{id}', [CategoriasController::class, 'remove'])->name('remove')->middleware('auth');
Route::post('/categorias/destroy/{id}', [CategoriasController::class, 'destroy'])->name('destroy')->middleware('auth');

/*Rotas subcategorias */
Route::get('/subcategorias', [SubcategoriasController::class, 'index'])->name('subcategorias')->middleware('auth');
Route::get('/subcategorias/create', [SubcategoriasController::class, 'create'])->name('create')->middleware('auth');
Route::post('/subcategorias/store', [SubcategoriasController::class, 'store'])->name('store')->middleware('auth');
Route::get('/subcategorias/show/{id}', [SubcategoriasController::class, 'show'])->name('show')->middleware('auth');
Route::post('/subcategorias/update/{id}', [SubcategoriasController::class, 'update'])->name('update')->middleware('auth');
Route::get('/subcategorias/remove/{id}', [SubcategoriasController::class, 'remove'])->name('remove')->middleware('auth');
Route::post('/subcategorias/destroy/{id}', [SubcategoriasController::class, 'destroy'])->name('destroy')->middleware('auth');

/* Rotas dos Produtos */
Route::get('/product', [ProdutosController::class, 'index'])->name('produtos')->middleware('auth');
Route::get('/produtos/create', [ProdutosController::class, 'create'])->name('create')->middleware('auth');
Route::post('/produtos/store', [ProdutosController::class, 'store'])->name('store')->middleware('auth');
Route::get('/produtos/show/{id}', [ProdutosController::class, 'show'])->name('show')->middleware('auth');
Route::post('/produtos/update/{id}', [ProdutosController::class, 'update'])->name('update')->middleware('auth');
Route::get('/produtos/remove/{id}', [ProdutosController::class, 'remove'])->name('remove')->middleware('auth');
Route::post('/produtos/destroy/{id}', [ProdutosController::class, 'destroy'])->name('destroy')->middleware('auth');
Route::get('/produtos/add/{id}', [ProdutosController::class, 'add'])->name('add')->middleware('auth');           
Route::post('/produtos/include/{id}',[ProdutosController::class, 'include'])->name('include')->middleware('auth');

/* Rotas Vendas */
Route::get('/vendas', [VendasController::class, 'index'])->name('vendas')->middleware('auth');
Route::post('/vendas/addCompra',[VendasController::class, 'store'])->name('store')->middleware('auth');
Route::post('/vendas/destroy/{id}',[VendasController::class, 'destroy'])->name('destroy')->middleware('auth');
Route::post('/vendas/destroyAll', [VendasController::class, 'destroyAll'])->name('destroyAll')->middleware('auth');

// Message
Route::get('/message', [MessageController::class, 'index'])->name('message');
Route::post('/message/send', [MessageController::class, 'send'])->name('send');
Route::post('/message/load/{id}', [MessageController::class, 'load'])->name('load')->middleware('auth');

//Reply messages
Route::get('/reply', [ReplyMessageController::class, 'index'])->name('reply')->middleware('auth');
Route::post('/reply/send/{id}', [ReplyMessageController::class, 'send'])->name('send')->middleware('auth');
