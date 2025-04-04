<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Atualizar Informações do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/usuarioUpdate.style.css">
</head>
<body>
    @if(Session::has('loginId'))
        @php
            $usuario = App\Models\Usuario::find(Session::get('loginId'));
        @endphp
        @if($usuario)
            <div class="container d-flex justify-content-center mt-5">
                <div class="row">
                    <div class="col">
                        <h1 class="mb-4 text-white">Atualizar Informações</h1>
                        <form action="{{route('atualizarUsuario')}}" method="POST">
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-white">Novo nome:</label>
                                <input type="text" name="nome" class="form-control" value='{{ $usuario->nome }}'>
                                <div class="error-message">@error('nome') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Novo email:</label>
                                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}">
                                <div class="error-message">@error('email') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Nova senha:</label>
                                <input type="password" name="senha" class="form-control">
                                <div class="error-message">@error('senha') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Novo CPF:</label>
                                <input type="number" name="cpf" class="form-control" value="{{ $usuario->cpf }}">
                                <div class="error-message">@error('cpf') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Novo telefone:</label>
                                <input type="number" name="telefone" class="form-control" value="{{ $usuario->telefone }}">
                                <div class="error-message">@error('telefone') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Novo estado:</label>
                                <input type="text" name="estado" class="form-control" value="{{ $usuario->estado }}">
                                <div class="error-message">@error('estado') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Nova cidade:</label>
                                <input type="text" name="cidade" class="form-control" value="{{ $usuario->cidade }}">
                                <div class="error-message">@error('cidade') {{$message}} @enderror</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Nova rua:</label>
                                <input type="text" name="rua" class="form-control" value="{{ $usuario->rua }}">
                                <div class="error-message">@error('rua') {{$message}} @enderror</div>
                            </div>
                            <a href="usuario" class="btn btn-info mt-3 mb-3 me-2">Voltar</a>
                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif

</body>
</html>