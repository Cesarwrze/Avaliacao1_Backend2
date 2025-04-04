<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\RelatorioController;

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

Route::get('/eletrobuy', function () {
    return view('index');
})->name('principal');

Route::get('/eletrobuy/registrar', [AutenticacaoController::class, 'registrar'])->middleware('alreadyLoggedIn');
Route::post('/eletrobuy/registrar', [AutenticacaoController::class, 'registrarUsuario'])->name('registrarUsuario');
Route::get('/eletrobuy/login', [AutenticacaoController::class, 'login'])->middleware('alreadyLoggedIn');
Route::post('/eletrobuy/login', [AutenticacaoController::class, 'loginUsuario'])->name('login');
Route::post('/eletrobuy/logout', [AutenticacaoController::class, 'logout'])->name('logout');
Route::get('/eletrobuy/usuario', [AutenticacaoController::class, 'usuario'])->name('usuario')->middleware('isLoggedIn');
Route::get('/eletrobuy/usuarioUpdate', [AutenticacaoController::class, 'usuarioUpdate'])->name('usuarioUpdate')->middleware('isLoggedIn');
Route::post('/eletrobuy/usuarioUpdate', [AutenticacaoController::class, 'atualizarUsuario'])->name('atualizarUsuario');
Route::post('/eletrobuy/usuarioDelete', [AutenticacaoController::class, 'deletarUsuario'])->name('deletarUsuario');

Route::get('/eletrobuy/produto', [ProdutoController::class, 'produto'])->middleware('isLoggedIn')->name('produto');
Route::post('/eletrobuy/produto', [ProdutoController::class, 'cadastrarProduto'])->name('cadastrarProduto');
Route::get('/eletrobuy/produtosCadastrados', [ProdutoController::class, 'produtosCadastrados'])->middleware('isLoggedIn')->name('produtosCadastrados');
Route::get('/eletrobuy/produtoUpdate/{id}', [ProdutoController::class, 'produtoUpdate'])->middleware('isLoggedIn')->name('produtoUpdate');
Route::put('/eletrobuy/produtoUpdate/{id}', [ProdutoController::class, 'atualizarProduto'])->name('atualizarProduto');
Route::delete('/eletrobuy/produtoDelete/{id}', [ProdutoController::class, 'deletarProduto'])->name('deletarProduto');

Route::get('/eletrobuy/categoria', [CategoriaController::class, 'categoria'])->middleware('isLoggedIn')->name('categoria');
Route::post('/eletrobuy/categoria', [CategoriaController::class, 'cadastrarCategoria'])->name('cadastrarCategoria');
Route::get('/eletrobuy/categoriaUpdate/{id}', [CategoriaController::class, 'categoriaUpdate'])->middleware('isLoggedIn')->name('categoriaUpdate');
Route::put('/eletrobuy/categoriaUpdate/{id}', [CategoriaController::class, 'atualizarCategoria'])->name('atualizarCategoria');
Route::delete('/eletrobuy/categoriaDelete/{id}', [CategoriaController::class, 'deletarCategoria'])->name('deletarCategoria');

Route::get('/eletrobuy/empresa', [EmpresaController::class, 'empresa'])->middleware('isLoggedIn')->name('empresa');
Route::post('/eletrobuy/empresa', [EmpresaController::class, 'cadastrarEmpresa'])->name('cadastrarEmpresa');
Route::get('/eletrobuy/empresaUpdate/{id}', [EmpresaController::class, 'empresaUpdate'])->middleware('isLoggedIn')->name('empresaUpdate');
Route::put('/eletrobuy/empresaUpdate/{id}', [EmpresaController::class, 'atualizarEmpresa'])->name('atualizarEmpresa');
Route::delete('/eletrobuy/empresaDelete/{id}', [EmpresaController::class, 'deletarEmpresa'])->name('deletarEmpresa');

Route::get('/eletrobuy/carrinho', [CarrinhoController::class, 'carrinho'])->middleware('isLoggedIn')->name('carrinho');
Route::post('/eletrobuy/carrinho/{id}', [CarrinhoController::class, 'adicionarCarrinho'])->name('adicionarCarrinho');
Route::post('/eletrobuy/removerCarrinho', [CarrinhoController::class, 'removerCarrinho'])->name('removerCarrinho');
Route::post('/eletrobuy/limparCarrinho', [CarrinhoController::class, 'limparCarrinho'])->name('limparCarrinho');
Route::post('/eletrobuy/finalizarCompra', [CarrinhoController::class, 'finalizarCompra'])->name('finalizarCompra');

Route::get('/eletrobuy/venda', [VendaController::class, 'venda'])->middleware('isLoggedIn')->name('venda');
Route::post('/eletrobuy/venda', [VendaController::class, 'cadastrarVenda'])->name('cadastrarVenda');
Route::put('/eletrobuy/confirmarCompra/{id}', [VendaController::class, 'confirmarCompra'])->name('confirmarCompra');
Route::delete('/eletrobuy/vendaDelete/{id}', [VendaController::class, 'deletarVenda'])->name('deletarVenda');

Route::get('/eletrobuy/relatorios', [RelatorioController::class, 'relatorios'])->middleware('isLoggedIn')->name('relatorios');
