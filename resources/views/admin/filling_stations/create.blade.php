@extends('layouts.master')

@section('title', 'Добави бензиностанция')

@section('content')
    <div class="container has-text-centered">
       <div class="columns is-mobile is-centered">
           <div class="column is-half">
               <h1>@yield('title')</h1>

               <form action="{{ route('admin.filling_stations.store') }}" method="post">
                   @csrf
                   @method('post')

                   <div class="field">
                       <h4 class="mt-2 mb-3">
                           <label class="label" for="name">Име</label>
                       </h4>
                       <input class="input is-primary is-small @error('name') is-danger @enderror"
                              id="name" name="name" type="text" value="{{ old('name') }}" >
                       @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>

                   <div class="field">
                       <h4 class="mt-2 mb-3">
                           <label for="road_id">Път</label>
                       </h4>

                       <div class="select is-primary is-small @error('road_id') is-danger @enderror">
                           <select id="road_id" name="road_id" class="has-text-centered">
                               @foreach($roads as $road)
                                   <option value="{{ $road->id }}">
                                       между
                                       {{ $road->from->name }}
                                       и
                                       {{ $road->to->name }} |
                                       {{ $road->minutes_needed }} минути |
                                       {{ $road->roadType->name }} път
                                   </option>
                               @endforeach

                               @if ($roads->isEmpty())
                                   <option>
                                       Няма нито един път между два града!
                                   </option>
                               @endif
                           </select>
                       </div>
                       @error('road_id')
                            <p class="help is-danger">{{ $message }}</p>
                       @enderror
                   </div>
                   <h4 class="mt-2 mb-3">
                       <label for="fuels">Горива</label>
                   </h4>
                   <div class="select is-primary is-multiple">
                       <select name="fuels[]" id="fuels" multiple size="8" class="has-text-centered">
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

                   <div class="has-text-centered mt-3">
                       <button class="button is-small is-success" type="submit" >Запиши</button>
                       <a class="button is-link is-small" href="{{ route('admin.filling_stations.index') }}">Откажи</a>
                   </div>
               </form>
           </div>
       </div>
    </div>
@endsection
