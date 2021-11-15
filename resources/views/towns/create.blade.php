@extends('layouts.master')

@section('title', 'Добави град')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>Добави град</h1>


               <form action="{{ route('towns.store') }}" method="post">
                   @csrf
                   @method('post')

                   <div class="form-group">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="name" type="text" value="{{ old('name') }}" >
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="buttons mt-2">
                       <button class="button is-small is-success" type="submit" >Запиши</button>
                       {{--        todo: move in admin panel, users should not CRUD towns, only admins--}}
                       <a class="button is-link is-small" href="{{ route('towns.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
