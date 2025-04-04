@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/carrinho.style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-white">Carrinho de Compras</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
        @if(count($produtos) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="table-info">
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr class="table-primary">
                                <td class="align-middle">
                                    <span class="text-truncate-custom" title="{{ $produto->nome }}">{{ $produto->nome }}</span>
                                </td>
                                <td class="align-middle text-center">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="align-middle text-center">{{ $carrinho[$produto->id] }}</td>
                                <td class="align-middle text-center">R$ {{ number_format($produto->preco * $carrinho[$produto->id], 2, ',', '.') }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('removerCarrinho') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <form action="{{ route('limparCarrinho') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Limpar Carrinho</button>
                </form>
            </div>

            <h4 class="text-white">Total: R$ {{ number_format($precoTotal, 2, ',', '.') }}</h4>
            <form action="{{ route('finalizarCompra') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="formaPagamento" class="form-label text-white">Forma de Pagamento</label>
                    <select class="form-control" name="formaPagamento" id="formaPagamento" required>
                        <option value="">Selecione...</option>
                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                        <option value="Boleto">Boleto</option>
                        <option value="Pix">Pix</option>
                    </select>
                </div>
                <div class="d-flex gap-2 mb-5 btn-group-responsive">
                    <a href="{{ route('principal') }}" class="btn btn-info">Voltar</a>
                    <a href="{{ route('venda') }}" class="btn btn-info">Histórico de compras</a>
                    <a href="{{ route('produtosCadastrados') }}" class="btn btn-info">Continuar comprando</a>
                    <button type="submit" class="btn btn-primary">Finalizar Compra</button>
                </div>
            </form>
        @else
            <p class="text-white">Seu carrinho está vazio.</p>
            <div class="btn-group-responsive d-flex gap-2">
                <a href="{{ route('principal') }}" class="btn btn-info">Voltar</a>
                <a href="{{ route('produtosCadastrados') }}" class="btn btn-info">Comprar produtos</a>
                <a href="{{ route('venda') }}" class="btn btn-info">Histórico de compras</a>
            </div>
        @endif
    </div>
</body>
</html>
@endsection