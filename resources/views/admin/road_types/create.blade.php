@extends('layouts.master')

@section('title', 'Добави тип път')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.road_types.store') }}" method="post">
                   @csrf
                   @method('post')

                   <div class="form-group">
                       <label class="label" for="type_name">Име</label>
                       <input class="input is-primary is-small @error('type_name') is-danger @enderror"
                              id="type_name" name="type_name" type="text">
                       @error('type_name')
                           <p class="help is-danger">{{ $message }}</p>
                       @enderror
                       <label class="label" for="hardship">Трудност</label>
                       <input class="input is-primary is-small @error('hardship') is-danger @enderror"
                              id="hardship" name="hardship" type="number">
                       @error('hardship')
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
