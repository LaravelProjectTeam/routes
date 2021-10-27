<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <strong>Маршрути</strong>
{{--            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">--}}
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
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
            <a class="navbar-item">
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
                        <a class="button is-primary">
                            <strong>My Profile</strong>
                        </a>
                        <a class="button is-primary">
                            <strong>Log out</strong>
                        </a>
                    @else
                        <a class="button is-primary">
                            <strong>Регистрация</strong>
                        </a>
                        <a class="button is-light">
                            Вход
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
