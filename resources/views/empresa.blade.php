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
                <h1 class="mb-4 text-white">Cadastro de Empresas</h1>

                <form action="{{route('cadastrarEmpresa')}}" method="post" class="mb-4">
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label text-white">Nome da Empresa</label>
                        <input type="text" id="nome" name="nome" class="form-control" value="{{old('nome')}}" placeholder="Nome">
                        <div class="error-message">@error('nome') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="cnpj" class="form-label text-white">CNPJ da Empresa</label>
                        <input type="number" id="cnpj" name="cnpj" class="form-control" value="{{old('cnpj')}}" placeholder="CNPJ">
                        <div class="error-message">@error('cnpj') {{$message}} @enderror</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email da Empresa</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                        <div class="error-message">@error('email') {{$message}} @enderror</div>
                    </div>
                    <a href="{{ route('principal') }}" class="btn btn-info mt-3 mb-5 me-2">Voltar</a>
                    <button type="submit" name="create" class="btn btn-primary mt-3 mb-5">Registrar</button>
                </form>
            </div>
        </div>

        <div>
            <h2 class="text-white">Lista de Empresas</h2>
            <table class="table table-bordered table-striped mb-5">
                <thead>
                    <tr class="table-info">
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr class="table-primary"> 
                        <td>{{ $empresa->nome }}</td>
                        <td>{{ $empresa->cnpj }}</td>
                        <td>{{ $empresa->email }}</td>
                        <td class="d-flex align-items-center gap-2"> 
                            <a href="{{ route('empresaUpdate', $empresa->id) }}" class="btn btn-info btn-sm h-100">Editar</a>
                            <form action="{{ route('deletarEmpresa', $empresa->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="deletarEmpresa(event)" class="btn btn-danger btn-sm">Deletar</button> 
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/empresa.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection