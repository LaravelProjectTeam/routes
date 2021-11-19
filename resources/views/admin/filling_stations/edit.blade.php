@extends('layouts.master')

@section('title', 'Редактирай бензиностанция')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1>@stack('title')</h1>

                <form action="{{ route('admin.filling_stations.update', $filling_station->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="field">
                        <h4 class="mt-2 mb-3">
                            <label class="label" for="name">Име</label>
                        </h4>
                        <input class="input is-primary is-small @error('name') is-danger @enderror"
                               id="name" name="name" type="text" value="{{ $filling_station->name }}" >
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <h4 class="mt-2 mb-3">
                            <label for="road_id">Път</label>
                        </h4>

                        <div class="select is-primary is-small @error('road_id') is-danger @enderror">
                            <select id="road_id" name="road_id" class="is-disabled has-text-centered" {{ 'disabled' }}>
                                <option value="{{ $filling_station->road->id }}" {{ 'selected' }}>
                                    между
                                    {{ $filling_station->road->from->name }}
                                    и
                                    {{ $filling_station->road->to->name }} |
                                    {{ $filling_station->road->minutes_needed }} минути |
                                    {{ $filling_station->road->roadType->name }} път
                                </option>

                                @if (!$filling_station->road)
                                    <option>
                                        Няма нито наличен път!
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
                                <option value="{{ $fuel->id }}"
                                    {{
                                        in_array($fuel->name, $filling_station->fuels->pluck('name')->toArray()) ?
                                        'selected' :
                                        ''
                                    }}
                                >
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
