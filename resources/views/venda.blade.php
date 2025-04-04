@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Histórico de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/venda.style.css">
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
            
            <h2 class="text-white">Histórico de Compras</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-5">
                    <thead>
                        <tr class="table-info">
                            <th>Data</th>
                            <th>Produtos</th>
                            <th>Total</th>
                            <th>Pagamento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vendas as $venda)
                        <tr class="table-primary">
                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($venda->dataVenda)->format('d/m/Y H:i') }}</td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                @foreach($venda->produtosRelacionados as $produto)
                                    <li>
                                        <span class="text-truncate-custom" title="{{ $produto->nome }} ({{ $produto->pivot->quantidade }}x) - R$ {{ number_format($produto->pivot->precoUnitario, 2, ',', '.') }}">
                                           - {{ $produto->nome }} ({{ $produto->pivot->quantidade }}x) - R$ {{ number_format($produto->pivot->precoUnitario, 2, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                            <td class="align-middle text-center">R$ {{ number_format($venda->precoTotal, 2, ',', '.') }}</td>
                            <td class="align-middle text-center">
                                <span class="text-truncate-custom" title="{{ $venda->formaPagamento }}">{{ $venda->formaPagamento }}</span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="badge {{ $venda->status == 'Pendente' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ ucfirst($venda->status) }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex gap-2 justify-content-center">
                                    @if($venda->status == 'Pendente')
                                    <form action="{{ route('deletarVenda', $venda->id) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="cancelarVenda(event)" class="btn btn-danger btn-sm">Cancelar</button>
                                    </form>
                                    <form action="{{ route('confirmarCompra', $venda->id) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Entregue</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma compra encontrada.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="btn-group-responsive">
                <a href="{{ route('principal') }}" class="btn btn-info mt-3 mb-5">Voltar</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/venda.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
