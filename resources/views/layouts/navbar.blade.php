<style>
    @import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    @import url('{{ asset('style/navbar.style.css') }}');
</style>

<nav id="navbar-site" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="">
            <a class="navbar-brand" href="{{route('principal')}}">EletroBuy</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">
                @if(Session::has('loginId'))
                    @php
                        $usuario = App\Models\Usuario::find(Session::get('loginId'));
                    @endphp
                    @if($usuario)
                        <div class="btn-group dropstart">
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('produto') }}">Produto</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('categoria') }}">Categoria</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('empresa') }}">Empresa</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('produtosCadastrados') }}">Comprar</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('relatorios') }}">Relatórios</a></li>
                        </div>
                    @endif
                @endif
            </ul>

            <ul class="navbar-nav ms-auto">
                @if(Session::has('loginId'))
                    @php
                        $usuario = App\Models\Usuario::find(Session::get('loginId'));
                    @endphp
                    @if($usuario)
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="navbar-text text-white">{{ $usuario->nome }}</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('usuario') }}">Minha Informações</a></li>
                                <li><a class="dropdown-item" href="{{ route('carrinho') }}">Meu Carrinho</a></li>
                                <li><a class="dropdown-item" href="{{ route('venda') }}">Meu Histórico</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger px-5 ms-4">Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <li>
                        <a href="eletrobuy/login">
                            <button id="button" type="button" class="btn btn-dark">Login</button>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>
@yield('content')