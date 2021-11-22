@extends('layouts.master')

@section('title', 'Контакти')

@section('content')
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">Контакти</h1>
                <p>Тук може да ни пишете при проблеми, препоръки и обратна връзка.</p>

{{--                todo: improve error displaying --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contacts.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="form-group mt-2">
                        <label class="label" for="name">Име</label>
                        <input class="input is-primary is-small" id="name" name="name" type="text" value="{{ old('name') }}" >
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="email">Имейл</label>
                        <input class="input is-primary is-small" id="email" name="email" type="email" value="{{ old('email') }}" >
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="subject">Тема</label>
                        <input class="input is-primary is-small" id="subject" name="subject" type="text" value="{{ old('subject') }}" >
                    </div>

                    <div class="form-group mt-2">
                        <label class="label" for="message">Съобщение</label>
                        <textarea class="textarea is-primary is-small" id="message" name="message" placeholder="Textarea">{{ old('message') }}</textarea>
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
