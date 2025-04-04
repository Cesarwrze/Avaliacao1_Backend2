<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/registrar.style.css">
  </head>
  <body>

    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header text-start  ">
                    <h3>Registrar-se</h3>
                </div>
                <div class="card-body m-0">
                    <form action="{{route('registrarUsuario')}}" method="post">
                        @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="text" name="nome" class="form-control" value="{{old('nome')}}" placeholder="Nome"></div>
                            <div class="error-message">@error('nome') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Email"></div>
                            <div class="error-message">@error('email') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="password" name="senha" class="form-control" value="{{old('senha')}}" placeholder="Senha"></div>
                            <div class="error-message">@error('senha') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="number" name="cpf" id="cpf" class="cpf form-control" value="{{old('cpf')}}" placeholder="CPF"></div>
                            <div class="error-message">@error('cpf') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="number" name="telefone" id="telefone" class="telefone form-control" value="{{old('telefone')}}" placeholder="Telefone"></div>
                            <div class="error-message">@error('telefone') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="text" name="estado" class="form-control" value="{{old('estado')}}" placeholder="Estado"></div>
                            <div class="error-message">@error('estado') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="text" name="cidade" class="form-control" value="{{old('cidade')}}" placeholder="Cidade"></div>
                            <div class="error-message">@error('cidade') {{$message}} @enderror</div>
                        </div>
                        <div class="input-group form-group mb-4 d-flex flex-column">
                            <div><input type="text" name="rua" class="form-control" value="{{old('rua')}}" placeholder="Rua"></div>
                            <div class="error-message">@error('rua') {{$message}} @enderror</div>
                        </div>
                        <div class="form-group text-end">
                            <input type="hidden" name="acao" value="inserir">
                            <input type="submit" name="Enviar" value="Registrar" class="btn btn-primary float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a href="login">Voltar a página anterior</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/registrar.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
