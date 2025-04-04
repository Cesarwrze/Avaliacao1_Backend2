<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Informações do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style/usuario.style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <h1 class="mb-4 text-white">Informações do Usuário</h1>
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label text-white">Nome:</label>
                            <input type="text" class="form-control" value='{{ $usuario->nome }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Email:</label>
                            <input type="email" class="form-control" value='{{ $usuario->email }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">CPF:</label>
                            <input type="number" class="form-control" value='{{ $usuario->cpf }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Telefone:</label>
                            <input type="text" class="form-control" value='{{ $usuario->telefone }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Estado:</label>
                            <input type="text" class="form-control" value='{{ $usuario->estado }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Cidade:</label>
                            <input type="text" class="form-control" value='{{ $usuario->cidade }}' disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Rua:</label>
                            <input type="text" class="form-control" value='{{ $usuario->rua }}' disabled>
                        </div>
                        <div class="d-flex">
                            <a href="{{ route('principal') }}" class="btn btn-info me-2">Voltar</a>
                            <a href="{{ route('usuarioUpdate') }}" class="btn btn-info me-2">Alterar Informações</a>
                            <form action="{{route('deletarUsuario')}}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" onclick="deletarConta(event)" class="btn btn-danger">Deletar Conta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/usuario.script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>