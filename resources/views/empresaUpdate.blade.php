@extends('layouts.navbar')
@section('content')
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/empresa.style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h1 class="mb-4 text-white">Editar Empresa</h1>

                <form action="{{route('atualizarEmpresa', $empresa->id)}}" method="post" class="mb-4">
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nome" class="form-label text-white">Nome da Empresa</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="{{ $empresa->nome }}" required>
                        <div class="error-message">@error('nome') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="cnpj" class="form-label text-white">CNPJ da Empresa</label>
                        <input type="text" id="cnpj" name="cnpj" class="form-control" value="{{ $empresa->cnpj }}" required>
                        <div class="error-message">@error('cnpj') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email da Empresa</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{ $empresa->email }}" required>
                        <div class="error-message">@error('email') {{$message}} @enderror</div>
                    </div>
                    <a href="{{ route('empresa') }}" class="btn btn-info mt-3 mb-5 me-2">Voltar</a>
                    <button type="submit" name="create" class="btn btn-primary mt-3 mb-5">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection