@extends('layouts.master')

@section('title', 'Редактирай тип път')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.road_types.update', $type->id) }}" method="post">
                   @csrf
                   @method('put')

                   <div class="form-group">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="type_name" type="text" value="{{$type->name}}" >
                       @error('type_name')
                           <p class="help is-danger">{{ $message }}</p>
                       @enderror
                       <label class="label" for="hardship">Трудност</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="hardship" name="hardship" type="number" value="{{$type->hardship_level}}" >
                       @error('hardship')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="buttons mt-2">
                       <button class="button is-small is-success" type="submit" >Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.road_types.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
