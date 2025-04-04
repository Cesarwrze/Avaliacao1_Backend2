<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class RelatorioController extends Controller
{
    public function relatorios()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $totalUsuarios = Usuario::count();

        $produtosMaisVendidos = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('produtos.nome', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('produtos.id', 'produtos.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $categoriasMaisVendidas = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('categorias', 'produtos.categoriaId', '=', 'categorias.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('categorias.nome as categoria', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('categorias.id', 'categorias.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $empresasMaisVenderam = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('empresas', 'produtos.empresaId', '=', 'empresas.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('empresas.nome as empresa', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('empresas.id', 'empresas.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $usuariosMaisCompraram = DB::table('vendas')
            ->join('usuarios', 'vendas.usuarioId', '=', 'usuarios.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('usuarios.nome', DB::raw('COUNT(vendas.id) as total_compras'))
            ->groupBy('usuarios.id', 'usuarios.nome')
            ->orderByDesc('total_compras')
            ->take(10)
            ->get();

        $usuariosComCompras = DB::table('usuarios')
            ->selectRaw('
                COUNT(DISTINCT CASE WHEN v.id IS NOT NULL THEN usuarios.id END) as usuarios_com_compras,
                COUNT(DISTINCT CASE WHEN v.id IS NULL THEN usuarios.id END) as usuarios_sem_compras
            ')
            ->leftJoin(DB::raw('(SELECT DISTINCT usuarioId, id FROM vendas WHERE dataVenda BETWEEN ? AND ?) as v'), 
                      'usuarios.id', '=', 'v.usuarioId')
            ->setBindings([$inicioMes, $fimMes])
            ->first();

        $mesAtual = Carbon::now()->format('F/Y');

        $dadosGrafico = [
            'totalUsuarios' => [
                'labels' => ['Total Usuários'],
                'values' => [$totalUsuarios],
            ],
            'usuariosComCompras' => [
                'labels' => ["Usuários com compras em $mesAtual", "Usuários sem compras em $mesAtual"],
                'values' => [$usuariosComCompras->usuarios_com_compras, $usuariosComCompras->usuarios_sem_compras],
            ],
            'produtosMaisVendidos' => [
                'labels' => $produtosMaisVendidos->pluck('nome')->toArray(),
                'values' => $produtosMaisVendidos->pluck('total_vendido')->toArray(),
            ],
            'categoriasMaisVendidas' => [
                'labels' => $categoriasMaisVendidas->pluck('categoria')->toArray(),
                'values' => $categoriasMaisVendidas->pluck('total_vendido')->toArray(),
            ],
            'empresasMaisVenderam' => [
                'labels' => $empresasMaisVenderam->pluck('empresa')->toArray(),
                'values' => $empresasMaisVenderam->pluck('total_vendido')->toArray(),
            ],
            'usuariosMaisCompraram' => [
                'labels' => $usuariosMaisCompraram->pluck('nome')->toArray(),
                'values' => $usuariosMaisCompraram->pluck('total_compras')->toArray(),
            ],
        ];

        return view('relatorios', compact('dadosGrafico'));
    }

    public function apiRelatorios() : JsonResponse
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();

        $totalUsuarios = Usuario::count();

        $produtosMaisVendidos = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('produtos.nome', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('produtos.id', 'produtos.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $categoriasMaisVendidas = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('categorias', 'produtos.categoriaId', '=', 'categorias.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('categorias.nome as categoria', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('categorias.id', 'categorias.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $empresasMaisVenderam = DB::table('vendaProduto')
            ->join('produtos', 'vendaProduto.produtoId', '=', 'produtos.id')
            ->join('empresas', 'produtos.empresaId', '=', 'empresas.id')
            ->join('vendas', 'vendaProduto.vendaId', '=', 'vendas.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('empresas.nome as empresa', DB::raw('SUM(vendaProduto.quantidade) as total_vendido'))
            ->groupBy('empresas.id', 'empresas.nome')
            ->orderByDesc('total_vendido')
            ->take(10)
            ->get();

        $usuariosMaisCompraram = DB::table('vendas')
            ->join('usuarios', 'vendas.usuarioId', '=', 'usuarios.id')
            ->whereBetween('vendas.dataVenda', [$inicioMes, $fimMes])
            ->select('usuarios.nome', DB::raw('COUNT(vendas.id) as total_compras'))
            ->groupBy('usuarios.id', 'usuarios.nome')
            ->orderByDesc('total_compras')
            ->take(10)
            ->get();

        $usuariosComCompras = DB::table('usuarios')
            ->selectRaw('
                COUNT(DISTINCT CASE WHEN v.id IS NOT NULL THEN usuarios.id END) as usuarios_com_compras,
                COUNT(DISTINCT CASE WHEN v.id IS NULL THEN usuarios.id END) as usuarios_sem_compras
            ')
            ->leftJoin(DB::raw('(SELECT DISTINCT usuarioId, id FROM vendas WHERE dataVenda BETWEEN ? AND ?) as v'), 
                      'usuarios.id', '=', 'v.usuarioId')
            ->setBindings([$inicioMes, $fimMes])
            ->first();

        $mesAtual = Carbon::now()->format('F/Y');

        $dadosGrafico = [
            'totalUsuarios' => [
                'labels' => ['Total Usuários'],
                'values' => [$totalUsuarios],
            ],
            'usuariosComCompras' => [
                'labels' => ["Usuários com compras em $mesAtual", "Usuários sem compras em $mesAtual"],
                'values' => [$usuariosComCompras->usuarios_com_compras, $usuariosComCompras->usuarios_sem_compras],
            ],
            'produtosMaisVendidos' => [
                'labels' => $produtosMaisVendidos->pluck('nome')->toArray(),
                'values' => $produtosMaisVendidos->pluck('total_vendido')->toArray(),
            ],
            'categoriasMaisVendidas' => [
                'labels' => $categoriasMaisVendidas->pluck('categoria')->toArray(),
                'values' => $categoriasMaisVendidas->pluck('total_vendido')->toArray(),
            ],
            'empresasMaisVenderam' => [
                'labels' => $empresasMaisVenderam->pluck('empresa')->toArray(),
                'values' => $empresasMaisVenderam->pluck('total_vendido')->toArray(),
            ],
            'usuariosMaisCompraram' => [
                'labels' => $usuariosMaisCompraram->pluck('nome')->toArray(),
                'values' => $usuariosMaisCompraram->pluck('total_compras')->toArray(),
            ],
        ];

        return response()->json($dadosGrafico);
    }
}
