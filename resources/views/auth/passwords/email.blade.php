@extends('layouts.master')

@section('title', 'Възстанови паролата')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">@yield('title')</h1>
                @if (session('status'))
                    <div class="notification is-primary">
                        <button class="delete"></button>
                        {{ session('status') }}
                    </div>
                @endif
{{--                {{__('messages.welcome')}}--}}
{{--                {{Lang::get('messages.welcome')}}--}}

{{--                <br>--}}
{{--                {{__('Reset Password Notification')}}--}}
{{--                {{Lang::get('messages.Reset Password Notification')}}--}}

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="field">
                        <label for="email" class="label">Имейл адрес</label>

                        <div class="col-md-6">
                            <input id="email" type="email" required
                                   class="input is-small is-primary @error('email') is-danger @enderror"
                                   name="email" value="{{ old('email') }}"
                                   autocomplete="email" autofocus>

                            @error('email')
                                <p class="help is-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="field row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="button is-primary is-small">
                                {{ 'Изпрати линк за възстановяване на паролата' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
