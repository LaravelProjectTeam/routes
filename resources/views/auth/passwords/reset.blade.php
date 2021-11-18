@extends('layouts.master')

@section('title', 'Възстанови паролата')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">@yield('title')</h1>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="field">
                        <label for="email" class="label">Имейл адрес</label>

                        <input id="email" type="email"
                               class="input is-small is-primary @error('email') is-danger @enderror"
                               name="email" value="{{ $email ?? old('email') }}"
                               required autocomplete="email" autofocus
                        >

                        @error('email')
                            <p class="help is-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password" class="label">Парола</label>

                        <input id="password" type="password"
                               class="input is-small is-primary @error('password') is-danger @enderror"
                               name="password"
                               required autocomplete="new-password"
                        >

                        @error('password')
                            <p class="help is-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password-confirm" class="label">Потвърждение на паролата</label>

                        <input id="password-confirm" type="password"
                               class="input is-small is-primary @error('password') is-danger @enderror"
                               name="password_confirmation"
                               required autocomplete="new-password"
                        >

                        @error('password')
                            <p class="help is-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="buttons is-centered">
                        <button type="submit" class="button is-small is-primary">
                            {{ 'Възстанови парола' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
