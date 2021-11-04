<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <strong>Маршрути</strong>
{{--            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">--}}
        </a>

        <a role="button" class="navbar-burger" id="burger">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="nav-links" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ route("home.index") }}">
                Начало
            </a>
            <a class="navbar-item" href="{{ route("towns.index") }}">
                Градове (потребители)
            </a>
            <a class="navbar-item" href="{{ route("routes.index") }}">
                Маршрути (потребители)
            </a>
            <a class="navbar-item" href="{{ route("contacts.create") }}">
                Контакти
            </a>
            <a class="navbar-item">
                Обратна връзка
            </a>
            <a class="navbar-item has-text-success">
                Административен панел
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @auth
                        <a class="button is-outlined is-primary" >
                            Профил
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('post')

                            <button class="button is-outlined is-danger" type="submit">Излез</button>
                        </form>
                    @else
<<<<<<< Updated upstream
{{--                        <a class="button is-outlined is-info" href="{{ route("register") }}>--}}
                        <a href="{{route('users.create')}}" class="button is-outlined is-info is-small">
=======
{{--                        <a class="button is-outlined is-info"  >--}}
                        <a class="button is-outlined is-info is-small" href="{{ route('register') }}" >
>>>>>>> Stashed changes
                            Регистрация
                        </a>
{{--                        <a class="button is-outlined is-primary" >--}}
                        <a class="button is-outlined is-primary is-small" href="{{ route('login') }}">
                            Вход
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
