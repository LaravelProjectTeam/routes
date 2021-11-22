@extends('layouts.master')

@section('title', 'Регистрирай се')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">@yield('title')</h1>
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="field">
                        <label class="label" for="name">Потребителско име</label>
                        <input id="name" type="text" required
                               name="name" autocomplete="name" autofocus value="{{ old('name') }}"
                               class="input is-primary is-small @error('name') is-danger @enderror"
                        >
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="email">Имейл адрес</label>
                        <input id="email" type="email" required
                               name="email" autocomplete="email" autofocus value="{{ old('email') }}"
                               class="input is-primary is-small @error('email') is-danger @enderror"
                        >
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="password">Парола</label>
                        <input id="password" type="password" required
                               name="password" autocomplete="current-password"
                               class="input is-primary is-small @error('password') is-danger @enderror"
                        >
                        @error('password')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password-confirm"
                               class="label">Повтори парола</label>
                        <input id="password-confirm" type="password" required
                               name="password_confirmation"  autocomplete="new-password"
                               class="input is-primary is-small @error('password') is-danger @enderror"
                        >
                    </div>

                    <div class="has-text-centered mt-3">
                        <button class="button is-small is-success mt-1" type="submit">Регистрирай се</button>
                        <a class="button is-link is-small mt-1" href="{{ route('home.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
