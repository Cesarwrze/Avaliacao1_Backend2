@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/produtosCadastrados.style.css">
</head>
<body>
<div class="container mt-5">
        <div>
            @if(Session::has('success'))
            <div class="alert alert-success col-4">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger col-4">{{Session::get('fail')}}</div>
            @endif
            <h2 class="text-white">Lista de Produtos</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-5">
                    <thead>
                        <tr class="table-info">
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Descrição</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Empresa</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($produtos as $produto)
                        <tr class="table-primary"> 
                            <td class="align-middle">
                                <span class="text-truncate-custom" title="{{ $produto->nome }}">{{ $produto->nome }}</span>
                            </td>
                            <td class="align-middle text-center">{{ $produto->preco }}</td>
                            <td class="align-middle">
                                <span class="text-truncate-custom" title="{{ $produto->descricao }}">{{ $produto->descricao }}</span>
                            </td>
                            <td class="align-middle text-center">{{ $produto->estoque }}</td>
                            <td class="align-middle text-center">
                                <span class="text-truncate-custom" title="{{ $produto->categoria->nome }}">{{ $produto->categoria->nome }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-truncate-custom" title="{{ $produto->empresa->nome }}">{{ $produto->empresa->nome }}</span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
                                    <div class="d-inline">
                                        <a href="{{ route('produtoUpdate', $produto->id) }}" class="btn btn-info btn-sm">Editar</a>
                                    </div>
                                    <form action="{{ route('deletarProduto', $produto->id) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="deletarProduto(event)" class="btn btn-danger btn-sm">Deletar</button>
                                    </form>
                                    <form action="{{ route('adicionarCarrinho', $produto->id) }}" method="POST" class="d-flex gap-2 align-items-center m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Adicionar ao carrinho</button>
                                        <div class="controle-quantidade d-flex gap-1 align-items-center">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="diminuirQuantidade(this)">-</button>
                                            <input type="number" name="quantidade" value="1" class="form-control input-quantidade">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="aumentarQuantidade(this, {{ $produto->estoque }})">+</button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('principal') }}" class="btn btn-info mt-3 mb-5 me-2">Voltar</a>
            <a href="{{ route('carrinho') }}" class="btn btn-info mt-3 mb-5 me-2">Ir para o carrinho</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/produtosCadastrados.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
