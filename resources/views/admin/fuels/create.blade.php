@extends('layouts.master')

@section('title', 'Добави гориво')

@section('content')
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1>@yield('title')</h1>

                <form action="{{ route('admin.fuels.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label class="label" for="name">Име</label>
                        <input class="input is-primary is-small @error('name') is-danger @enderror"
                               id="name" name="fuel_name" type="text"  >
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="buttons mt-2">
                        <button class="button is-small is-success" type="submit" >Запиши</button>
                        <a class="button is-link is-small" href="{{ route('admin.users.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
