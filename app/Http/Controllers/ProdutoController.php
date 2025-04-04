<?php
namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function produto()
    {
        $produtos = Produto::with('categoria', 'empresa')->get();
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        return view('produto', compact('produtos', 'categorias', 'empresas'));
    }

    public function produtosCadastrados()
    {
        $produtos = Produto::with('categoria', 'empresa')->get();
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        return view('produtosCadastrados', compact('produtos', 'categorias', 'empresas'));
    }

    public function cadastrarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric|between:0,999999.99',
            'descricao' => 'required|max:255',
            'estoque' => 'required|numeric',
            'categoriaId' => 'required|exists:categorias,id',
            'empresaId' => 'required|exists:empresas,id'
        ], [
            'preco.between' => 'O preço deve estar entre R$ 0,00 e R$ 999.999,99'
        ]);

        try {
            Produto::create($request->all());
            return redirect()->route('produto')->with('success', 'Produto criado com sucesso.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '22003') {
                return redirect()->back()
                    ->withInput()
                    ->with('fail', 'O preço está fora do limite permitido. O valor máximo é R$ 999.999,99');
            }
            throw $e;
        }
    }

    public function produtoUpdate($id)
    {
        $produto = Produto::findOrFail($id);
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        return view('produtoUpdate', compact('produto', 'categorias', 'empresas'));
    }

    public function atualizarProduto(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
            'descricao' => 'required|max:255',
            'estoque' => 'required|numeric',
            'categoriaId' => 'required|exists:categorias,id',
            'empresaId' => 'required|exists:empresas,id'
        ]);
        
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
        return redirect()->route('produtosCadastrados')->with('success', 'Produto atualizado com sucesso.');
    }

    public function deletarProduto($id)
    {
        Produto::destroy($id);
        return redirect()->route('produtosCadastrados')->with('success', 'Produto deletado com sucesso.');
    }

}