@extends('layouts.master')

@section('title', 'Редактирай град')

@section('content')
    <div class="container has-text-centered">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.towns.update', $town->id) }}" method="post">
                   @csrf
                   @method('put')

                   <div class="field">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="name" type="text" value="{{ old('name') ?? $town->name }}">
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="has-text-centered mt-2">
                       <button class="button is-small is-success" type="submit">Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.towns.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
