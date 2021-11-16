@extends('layouts.master')

@section('title', 'Добави гориво')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1>@yield('title')</h1>

                <form action="{{ route('admin.fuels.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="form-group">
                        <label class="label" for="fuel_name">Име</label>
                        <input class="input is-primary is-small @error('fuel_name') is-danger @enderror"
                               id="fuel_name" name="fuel_name" type="text" value="{{ old('fuel_name') }}" >
                        @error('fuel_name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="has-text-centered mt-2">
                        <button class="button is-small is-success" type="submit" >Запиши</button>
                        <a class="button is-link is-small" href="{{ route('admin.fuels.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
