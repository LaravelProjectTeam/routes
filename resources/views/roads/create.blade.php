@extends('layouts.master')

@section('title', 'Добави тип път')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>Добави тип път</h1>


               <form action="{{ route('types.store') }}" method="post">
                   @csrf
                   @method('post')

                   <div class="form-group">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="type_name" type="text"  >
                        <label class="label" for="name">Трудност</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="hardship" name="hardship" type="number"  >
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="buttons mt-2">
                       <button class="button is-small is-success" type="submit" >Запиши</button>
                       {{--        todo: move in admin panel, users should not CRUD towns, only admins--}}
                       <a class="button is-link is-small" href="{{ route('users.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection