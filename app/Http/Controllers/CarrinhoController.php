<?php
namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    public function carrinho()
    {
        $carrinho = Session::get('carrinho', []);
        $produtos = [];
        $precoTotal = 0;
        
        if (!empty($carrinho)) {
            $produtos = Produto::whereIn('id', array_keys($carrinho))->get();
            foreach ($produtos as $produto) {
                $precoTotal += $produto->preco * $carrinho[$produto->id];
            }
        }
        
        return view('carrinho', compact('produtos', 'carrinho', 'precoTotal'));
    }

    public function limparCarrinho()
    {
        Session::forget('carrinho');
        return redirect()->route('carrinho')->with('success', 'Carrinho esvaziado com sucesso!');
    }

    public function adicionarCarrinho($id, Request $request)
    {
        $quantidade = $request->input('quantidade', 1);
        $carrinho = Session::get('carrinho', []);
        
        if (isset($carrinho[$id])) {
            $carrinho[$id] += $quantidade;
        } else {
            $carrinho[$id] = $quantidade;
        }
        
        $produto = Produto::find($id);
        if ($produto->estoque === 0) {
            return redirect()->back()->with('fail', 'Não há produtos no estoque!');
        } else if ($quantidade < 1) {
            return redirect()->back()->with('fail', 'A quantidade mínima deve ser 1!');
        } else if ($quantidade > $produto->estoque) {
            return redirect()->back()->with('fail', 'O limite do estoque não pode ser excedido!');
        }

        if ($carrinho[$id] > $produto->estoque) {
            $carrinho[$id] = $produto->estoque;
        }
        
        Session::put('carrinho', $carrinho);
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    public function removerCarrinho(Request $request)
    {
        $produtoId = $request->produto_id;
        $carrinho = Session::get('carrinho', []);
        
        if (isset($carrinho[$produtoId])) {
            if ($carrinho[$produtoId] > 1) {
                $carrinho[$produtoId]--;
            } else {
                unset($carrinho[$produtoId]);
            }
        }
        
        Session::put('carrinho', $carrinho);
        return redirect()->route('carrinho');
    }

    public function finalizarCompra(Request $request)
    {
        $request->validate([
            'formaPagamento' => 'required'
        ]);

        $carrinho = Session::get('carrinho', []);
        $precoTotal = 0;

        $produtos = Produto::whereIn('id', array_keys($carrinho))->get();
        
        foreach ($produtos as $produto) {
            $quantidade = $carrinho[$produto->id];
            if ($quantidade > $produto->estoque) {
                return redirect()->route('carrinho')
                    ->with('fail', "Produto {$produto->nome} não tem estoque suficiente.");
            }
            $precoTotal += $produto->preco * $quantidade;
        }

        if ($precoTotal > 9999999.99) {
            return redirect()->route('carrinho')
                ->with('fail', 'O valor total da compra excede o limite permitido (R$ 9.999.999,99). Por favor, reduza a quantidade de itens.');
        }

        DB::beginTransaction();
        try {
            $venda = new Venda();
            $usuario = Usuario::find(Session::get('loginId'));
            $venda->usuarioId = $usuario->id;
            $venda->formaPagamento = $request->formaPagamento;
            $venda->status = 'Pendente';
            $venda->dataVenda = now();
            $venda->precoTotal = $precoTotal;
            $venda->save();

            foreach ($produtos as $produto) {
                $quantidade = $carrinho[$produto->id];
                $produto->estoque -= $quantidade;
                $produto->save();

                $venda->produtosRelacionados()->attach($produto->id, [
                    'quantidade' => $quantidade,
                    'precoUnitario' => $produto->preco
                ]);
            }

            DB::commit();
            Session::forget('carrinho');
            return redirect()->route('carrinho')
                ->with('success', 'Compra finalizada com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('carrinho')
                ->with('fail', 'Erro ao finalizar a compra. O valor total excede o limite permitido.');
        }
    }
}
