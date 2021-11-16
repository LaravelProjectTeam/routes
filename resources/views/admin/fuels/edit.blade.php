@extends('layouts.master')

@section('title', 'Добави гориво')

@section('content')
<form action="{{ route('admin.fuels.update', $fuel->id) }}" method="post">
                   @csrf
                   @method('put')

                   <div class="form-group">
                       <label class="label" for="name">Име</label>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="fuel_name" type="text" value="{{ $fuel->name }}">
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="buttons mt-2">
                       <button class="button is-small is-success" type="submit">Запиши</button>
{{--                               todo: move in admin panel, users should not CRUD towns, only admins--}}
                       <a class="button is-link is-small" href="{{ route('admin.fuels.index') }}">Откажи</a>
                   </div>
               </form>
@endsection
