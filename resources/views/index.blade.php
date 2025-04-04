@extends('layouts.navbar')
@section('content')
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Avaliação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/index.style.css">
  </head>
  <body id="corpo">

    <div class="container text-center mt-5">
      <div class="row align-items-center justify-content-center">
        <div class="col-auto">
          <figure>
            <blockquote class="blockquote">
              <p class="text-white fs-1">"A tecnologia move o mundo"</p>
            </blockquote>
            <figcaption class="blockquote-footer text-end">
              <cite class="text-white" title="Source Title">Steve Jobs</cite>
            </figcaption>
          </figure>
        </div>
      </div>

      <div class="row pt-5 pb-5">
        @if(Session::has('loginId'))
            @php
                $usuario = App\Models\Usuario::find(Session::get('loginId'));
            @endphp
            @if($usuario)
              <div class="col-auto">
                <div class="card-group">
                  <div class="card border-light text-start">
                    <a href="{{ route('produto') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_produto.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Produto</h5>
                        <p class="card-text">Realize o cadastro de um produto desejado no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="{{ route('categoria') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_categoria.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Categoria</h5>
                        <p class="card-text">Realize o cadastro de uma categoria desejada no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="{{ route('empresa') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_empresa.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Empresa</h5>
                        <p class="card-text">Realize o cadastro de uma empresa desejada no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>           
                  <div class="card border-light text-start">
                    <a href="{{ route('produtosCadastrados') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/comprar_produto.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Comprar Produto</h5>
                        <p class="card-text">Realize a requisição de produtos desejados no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>          
                </div>

                <div class="card-group">
                  <div class="card border-light text-start">
                    <a href="{{ route('usuario') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/minhas_informacoes.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Minhas Informações</h5>
                        <p class="card-text">Veja todas as informações e dados referentes a sua conta no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="{{ route('carrinho') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/meu_carrinho.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Meu carrinho</h5>
                        <p class="card-text">Veja todos os produtos que você adicionou no carrinho no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="{{ route('venda') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/historico_compras.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Histórico de compras</h5>
                        <p class="card-text">Veja todas as compras de produtos já realizadas por você no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>           
                  <div class="card border-light text-start">
                    <a href="{{ route('relatorios') }}" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/relatorios_compras.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Relatórios</h5>
                        <p class="card-text">Veja uma lista dos relatórios de compras/vendas realizadas no site da Eletrobuy</p>
                      </div>
                    </a>
                  </div>          
                </div>
              </div>
            @endif

        @else
              <div class="col-auto">
                <div class="card-group">
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_produto.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Produto</h5>
                        <p class="card-text">Realize o cadastro de um produto desejado no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_categoria.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Categoria</h5>
                        <p class="card-text">Realize o cadastro de uma categoria desejada no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/cadastrar_empresa.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Cadastrar Empresa</h5>
                        <p class="card-text">Realize o cadastro de uma empresa desejada no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>           
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/comprar_produto.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Comprar Produto</h5>
                        <p class="card-text">Realize a requisição de produtos desejados no sistema de compras da Eletrobuy</p>
                      </div>
                    </a>
                  </div>          
                </div>

                <div class="card-group">
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/minhas_informacoes.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Minhas Informações</h5>
                        <p class="card-text">Veja todas as informações e dados referentes a sua conta no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/meu_carrinho.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Meu carrinho</h5>
                        <p class="card-text">Veja todos os produtos que você adicionou no carrinho no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/historico_compras.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Histórico de compras</h5>
                        <p class="card-text">Veja todas as compras de produtos já realizadas por você no sistema da Eletrobuy</p>
                      </div>
                    </a>
                  </div>           
                  <div class="card border-light text-start">
                    <a href="#" onclick="avisoLogin(event)" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                      <img src="/img/relatorios_compras.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Relatórios</h5>
                        <p class="card-text">Veja uma lista dos relatórios de compras/vendas realizadas no site da Eletrobuy</p>
                      </div>
                    </a>
                  </div>          
                </div>
              </div>
        @endif

      </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/index.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
@endsection