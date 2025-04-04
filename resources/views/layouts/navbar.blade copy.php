<link rel="stylesheet" href="style/navbar.style.css">
<nav id="navbar-site" class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div>
            <img src="img/logo.png" alt="">
            <a class="navbar-brand" href="eletrobuy">EletroBuy</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

        <!-- <ul class="navbar-nav ms-auto">
                <div class="btn-group dropstart">
                <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../Backend/usuario.php">Minha Informações</a></li>
                    <li><a class="dropdown-item" href="../Backend/carrinho.php">Meu carrinho</a></li>
                    <li><a class="dropdown-item" href="../Backend/historico_compra.php">Histórico Compras</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <a href="../Backend/logout.php">
                        <button id="sair" type="button" class="btn btn-danger px-5 ms-4">Sair</button>
                    </a>
                    <div class="px-2">

                        <button id="loadingSair" class="btn btn-danger d-none px-4 ms-4" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                        <span role="status">Sair</span>
                        </button>
                    </div>
                    </li>
                </ul>
                </div>
            
                <li>
                <a href="eletrobuy/login">
                    <button id="button" type="button" class="btn btn-dark">Login</button>
                </a>
                <button id="loadingButton" class="btn btn-dark d-none m-0" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Login</span>
                </button>
                </li>
        </ul> -->

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
                                <li><a class="dropdown-item" href="eletrobuy/usuario">Minha Informações</a></li>
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