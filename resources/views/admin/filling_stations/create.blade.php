@extends('layouts.master')

@section('title', 'Добави бензиностанция')

@section('content')
    <div class="container">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.filling_stations.store') }}" method="post">
                   @csrf
                   @method('post')

                   <div class="form-group">
                       <h4 class="mt-2 mb-3">
                           <label class="label" for="name">Име</label>
                       </h4>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="name" type="text" value="{{ old('name') }}" >
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="form-group">
                       <h4 class="mt-2 mb-3">
                           <label for="edge_id">Път</label>
                       </h4>

                       <div class="select is-small @error('edge_id') is-danger @enderror">
                           <select id="edge_id" name="edge_id">
                               @foreach($direct_routes as $route)
{{--                                   <option value="{{ $route->id }}"{{ ($to ?? '') === $route->id ? 'selected' : '' }}>--}}
                                   <option value="{{ $route->id }}">
                                       между
                                       {{ $route->from->name }}
                                       и
                                       {{ $route->to->name }} -
                                       {{ $route->minutes_needed }} минути -
                                       {{ $route->roadType->name }} път
                                   </option>
                               @endforeach

                               @if ($direct_routes->isEmpty())
                                   <option>
                                       Няма нито един път между два града!
                                   </option>
                               @endif
                           </select>
                       </div>
                       @error('edge_id')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>
                   <h4 class="mt-2 mb-3">
                       <label for="fuels">Горива</label>
                   </h4>
                   <div class="select is-multiple">
                       <select name="fuels[]" id="fuels" multiple size="8">
                           @foreach($fuels as $fuel)
                               <option value="{{ $fuel->id }}">
                                   {{ $fuel->name }}
                               </option>
                           @endforeach

                           @if ($fuels->isEmpty())
                               <option>
                                   Нямаме нито едно налично гориво!
                               </option>
                           @endif
                       </select>
                   </div>

                   <div class="buttons mt-3">
                       <button class="button is-small is-success" type="submit" >Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.filling_stations.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
