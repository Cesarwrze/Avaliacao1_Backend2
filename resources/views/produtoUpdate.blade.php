@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/produto.style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h1 class="mb-4 text-white">Editar Produto</h1>

                <form action="{{route('atualizarProduto', $produto->id)}}" method="post" class="mb-4">
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nome" class="form-label text-white">Nome da Produto</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="{{ $produto->nome }}" required>
                        <div class="error-message">@error('nome') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label text-white">Preço do Produto</label>
                        <input type="number" step="0.01" id="preco" name="preco" class="form-control" value="{{ $produto->preco }}" placeholder="Preço">
                        <div class="error-message">@error('preco') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label text-white">Descrição do Produto</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="4" placeholder="Digite a descrição do produto">{{ $produto->descricao }}</textarea>
                        <div class="error-message">@error('descricao') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="estoque" class="form-label text-white">Estoque do Produto</label>
                        <input type="number" id="estoque" name="estoque" class="form-control" value="{{ $produto->estoque }}" placeholder="Estoque">
                        <div class="error-message">@error('estoque') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="categoriaId" class="form-label text-white">Categoria do Produto</label>
                        <select id="categoriaId" name="categoriaId" class="form-control">
                            <option value="" disabled>Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $produto->categoriaId == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class="error-message">@error('categoriaId') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="empresaId" class="form-label text-white">Empresa do Produto</label>
                        <select id="empresaId" name="empresaId" class="form-control">
                            <option value="" disabled>Selecione uma empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{ $produto->empresaId == $empresa->id ? 'selected' : '' }}>
                                    {{ $empresa->nome }}
                                </option>
                            @endforeach
                        </select>
                        <div class="error-message">@error('empresaId') {{$message}} @enderror</div>
                    </div>
                    <a href="{{ route('produto') }}" class="btn btn-info mt-3 mb-5 me-2">Voltar</a>
                    <button type="submit" name="create" class="btn btn-primary mt-3 mb-5">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection