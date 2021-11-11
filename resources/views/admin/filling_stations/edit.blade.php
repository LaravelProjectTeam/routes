@extends('layouts.master')

@section('title', 'Редактирай бензиностанция')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>Редактирай бензиностанция</h1>
               <form action="{{ route('admin.filling_stations.update', $filling_station->id) }}" method="post">
                   @csrf
                   @method('put')

{{--                   todo: finish up here--}}
                   <div class="form-group">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="name" type="text" value="{{ $town->name }}">
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="buttons mt-2">
                       <button class="button is-small is-success" type="submit">Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.filling_stations.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
