@extends('layouts.master')

@section('title', 'Редактирай тип път')

@section('content')
    <div class="container has-text-centered">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.road_types.update', $road_type->id) }}" method="post">
                   @csrf
                   @method('put')

                   <div class="field">
                       <label class="label" for="type_name">Име</label>
                       <input class="input is-primary is-small @error('type_name') is-danger @enderror"
                              id="type_name" name="type_name" type="text"
                              value="{{ old('type_name') ?? $road_type->name }}">
                       @error('type_name')
                           <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="field mt-2">
                       <label class="label" for="hardship">Трудност</label>
                       <input class="input is-primary is-small @error('hardship') is-danger @enderror"
                              id="hardship" name="hardship" type="number"
                              value="{{ old('hardship') ?? $road_type->hardship_level}}">
                       @error('hardship')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="has-text-centered mt-2">
                       <button class="button is-small is-success" type="submit">Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.road_types.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
