@extends('layouts.master')

@section('title', 'Влез')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">@yield('title')</h1>
                <form action="{{ route('login') }}" method="post">
                    @csrf

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
                        <div class="checkbox">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ 'Запомни ме' }}
                            </label>
                        </div>
                    </div>

                    <div class="has-text-centered mt-3">
                        <button class="button is-small is-success" type="submit" >Вход</button>
                        <a class="button is-link is-small" href="{{ route('home.index') }}">Откажи</a>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="button is-outlined is-small mt-1" href="{{ route('password.request') }}">
                            {{ ('Забравена парола?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
