@extends('layouts.master')

@section('title', 'Контакти')

@section('content')
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">Контакти</h1>
                <p>
                    {{
                        'Можете да използвате тази форма, за да ни изпратите имейл съобщение.
                         Не се колебайте да ни пишете при проблеми със сайта или ако искате да дадете обратна връзка /
                         да направите предложение!'
                    }}
                </p>
{{--                todo: improve error displaying --}}
                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="form-group mt-2">
                        <label class="label" for="name">Име</label>
                        <input class="input is-primary is-small @error('name') is-danger @enderror"
                               id="name" name="name" type="text" value="{{ old('name') }}" >
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="email">Имейл</label>
{{--                        todo: type=email--}}
                        <input class="input is-primary is-small @error('email') is-danger @enderror"
                               id="email" name="email" type="text" value="{{ old('email') }}" >
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="subject">Тема</label>
                        <input class="input is-primary is-small @error('subject') is-danger @enderror"
                               id="subject" name="subject" type="text" value="{{ old('subject') }}" >
                        @error('subject')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="message">Съобщение</label>
                        <textarea class="textarea is-primary is-small @error('message') is-danger @enderror"
                                  id="message" name="message" placeholder="Textarea">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="buttons mt-3">
                        <button class="button is-small is-success" type="submit" >Изпрати</button>
                        <a class="button is-link is-small" href="{{ route('home.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
