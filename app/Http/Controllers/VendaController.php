<?php
namespace App\Http\Controllers;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{

    public function venda()
    {
        $usuario = Usuario::find(Session::get('loginId'));
        $vendas = Venda::with('produtosRelacionados')
                      ->where('usuarioId', $usuario->id)
                      ->orderBy('dataVenda', 'desc')
                      ->get();
        $produtos = Produto::all();
        return view('venda', compact('vendas', 'produtos'));
    }

    public function cadastrarVenda(Request $request)
    {
        $request->validate([
            'usuarioId' => 'required|exists:users,id', 
            'produtos' => 'required|array',           
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'produtos.*.precoUnitario' => 'required|numeric|min:0',
            'precoTotal' => 'required|numeric|min:0',
            'formaPagamento' => 'required|string',
        ]);

        $venda = Venda::create([
            'usuarioId' => $request->usuarioId,
            'precoTotal' => $request->precoTotal,
            'formaPagamento' => $request->formaPagamento,
            'status' => 'Pendente', 
            'dataVenda' => now(),
        ]);

        foreach ($request->produtos as $produto) {
            $venda->produtosRelacionados()->attach($produto['id'], [
                'quantidade' => $produto['quantidade'],
                'precoUnitario' => $produto['precoUnitario'],
            ]);
        }

        return redirect()->route('venda')->with('success', 'Compra realizada com sucesso.');
    }

    public function confirmarCompra(Request $request, $id) {
        $venda = Venda::findOrFail($id);
        $venda->update([
            'status' => 'Entregue'
        ]);

        return redirect()->route('venda')->with('success', 'Pedido confirmado e entragado com sucesso.');
    }

    public function atualizarVenda(Request $request, $id)
    {
        $request->validate([
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
            'produtos.*.precoUnitario' => 'required|numeric|min:0',
            'precoTotal' => 'required|numeric|min:0',
            'formaPagamento' => 'required|string',
        ]);

        $venda = Venda::findOrFail($id);
        
        $venda->update([
            'precoTotal' => $request->precoTotal,
            'formaPagamento' => $request->formaPagamento,
        ]);
        
        $produtosAtualizados = [];
        foreach ($request->produtos as $produto) {
            $produtosAtualizados[$produto['id']] = [
                'quantidade' => $produto['quantidade'],
                'precoUnitario' => $produto['precoUnitario'],
            ];
        }
        
        $venda->produtosRelacionados()->sync($produtosAtualizados);
        return redirect()->route('venda')->with('success', 'Pedido confirmado e entragado com sucesso.');
    }

    public function deletarVenda($id)
    {
        DB::beginTransaction();
        try {
            $venda = Venda::with('produtosRelacionados')->findOrFail($id);
            
            foreach ($venda->produtosRelacionados as $produto) {
                $produto->update([
                    'estoque' => $produto->estoque + $produto->pivot->quantidade
                ]);
            }
            
            $venda->produtosRelacionados()->detach();
            $venda->delete();
            
            DB::commit();
            return redirect()->route('venda')->with('success', 'Compra cancelada com sucesso e estoque atualizado.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('venda')->with('fail', 'Erro ao cancelar a compra. Por favor, tente novamente.');
        }
    }
}