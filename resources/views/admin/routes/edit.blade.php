@extends('layouts.master')

@section('title', 'Редактирай директен път между два града')

@section('content')
    <div class="container has-text-centered">
        <h1>@yield('title')</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>От град</th>
                    <th>До град</th>
                    <th>Разстояние (км)</th>
                    <th>Максимална скорост (км/ч)</th>
                    <th>Нужни минути</th>
                    <th>Бензиностанции</th>
                    <th>Вид</th>
                    <th>Създаден на</th>
                    <th>Обновен на</th>
                    <th>Редактирай</th>
                    <th>Изтрий</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{ route('admin.routes.show', $route->id) }}">{{ $route->id }}</a></td>
                    <td>#{{ $route->from->id  }} - {{ $route->from->name }}</td>
                    <td>#{{ $route->to->id }} - {{ $route->to->name }}</td>
                    <td>{{ $route->distance_in_km }}</td>
                    <td>{{ $route->max_speed_in_km_per_hour }}</td>
{{--                    <td>{{ dd($route->filling_stations) }}</td>--}}
{{--                    <td>{{ $route->minutes_needed }}</td>--}}
                    <td>{{ round($route->minutes_needed) }}</td>
                    <td>
                        @foreach($route->fillingStations ?? [] as $filling_station)
                            <div>
                                <span>{{ $filling_station->name }}</span>
                                -
                                <span>
                                    горива:
                                    {{
                                        $filling_station->fuels->count() ?
                                        join(', ', $filling_station->fuels->pluck('name')->toArray()) :
                                        'няма горива'
                                    }}
                                </span>
                            </div>
                        @endforeach
                        {{ $route->fillingStations->count() === 0 ? 'няма' : '' }}
                    </td>
                    <td>{{ $route->roadType->name }}</td>
                    <td>{{ isset($route->created_at) ? $route->created_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                    <td>{{ isset($route->updated_at) ? $route->updated_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                    <td><a class="button is-warning is-small" href="{{ route('admin.routes.edit', $route->id) }}">Редактирай</a></td>
                    <td>
                        <form action="{{ route('admin.routes.destroy', $route->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <button class="button is-danger is-small" type="submit">Изтрий</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="columns is-mobile is-centered mt-2">
            <div class="column is-half">
                <h1 class="">@yield('title')</h1>

                <form action="{{ route('admin.routes.update', $route->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="columns">
                        <div class="column is-one-half has-text-centered">
                            <h4 class="mt-3">
                                <label for="from_town_id">Начало</label>
                            </h4>
                            <div class="select is-primary is-small
                                 @error('to_town_id') is-danger @enderror
                                 @error('from_town_id') is-danger @enderror"
                            >
                                <select id="from_town_id" name="from_town_id" class="is-disabled has-text-centered" {{ 'disabled' }}>
                                    <option value="{{ $route->from->id }}" {{ 'selected' }}>
                                        {{ $route->from->name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="column is-one-half has-text-centered">
                            <h4 class="mt-3">
                                <label for="to_town_id">Край</label>
                            </h4>
                            <div class="select is-primary is-small
                                 @error('to_town_id') is-danger @enderror
                                 @error('from_town_id') is-danger @enderror"
                            >
                                <select id="to_town_id" name="to_town_id" class="is-disabled has-text-centered" {{ 'disabled' }}>
                                    <option value="{{ $route->to->id }}" {{ 'selected' }}>
                                        {{ $route->to->name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if ($errors->get('to_town_id') )
                        <p class="help is-danger">
                           {{ $errors->toArray()['to_town_id'][0] }}
                        </p>
                    @elseif ($errors->get('from_town_id'))
                        <p class="help is-danger">
                           {{ $errors->toArray()['from_town_id'][0] }}
                        </p>
                    @endif

                    <div class="field mt-2">
                        <label class="label" for="max_speed_in_km_per_hour">Максимална скорост (км/ч)</label>
                        <input class="input is-primary is-small @error('max_speed_in_km_per_hour') is-danger @enderror"
                               id="max_speed_in_km_per_hour" name="max_speed_in_km_per_hour"
                               value="{{ old('max_speed_in_km_per_hour') ?? $route->max_speed_in_km_per_hour }}" >
                        @error('max_speed_in_km_per_hour')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field mt-2">
                        <label class="label" for="distance_in_km">Разстояние (км)</label>
                        <input class="input is-primary is-small @error('distance_in_km') is-danger @enderror"
                               id="distance_in_km" name="distance_in_km"
                               value="{{ old('distance_in_km') ?? $route->distance_in_km }}" >
                        @error('distance_in_km')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field mt-2 has-text-centered">
                        <h6 class="mb-2">
                            <label for="road_type_id">Тип на пътя</label>
                        </h6>
                        <div class="select is-primary is-small">
                            <select id="road_type_id" name="road_type_id" class="has-text-centered">
                                @foreach($road_types ?? [] as $road_type)
                                    <option
                                        value="{{ $road_type->id }}"
                                        {{ (old('road_type') ?? $route->roadType->id) == $road_type->id ? 'selected' : '' }}
                                    >
                                        {{ $road_type->name }} - трудност: {{ $road_type->hardship_level }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
{{--                    debug only --}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <p class="help is-danger">--}}
{{--                            {{ $error }}<br/>--}}
{{--                        </p>--}}
{{--                    @endforeach--}}

                    <div class="has-text-centered mt-2">
                        <button class="button is-small is-success" type="submit" >Запиши</button>
                        <a class="button is-link is-small" href="{{ route('admin.routes.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
