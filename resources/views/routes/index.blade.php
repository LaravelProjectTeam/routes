@extends('layouts.master')

@section('title', 'Всички пътища')

@section('content')
    <div class="container has-text-centered">
        <h1 class="has-text-centered">Всички директни пътища</h1>

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
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td><a href="{{ route('routes.show', $route->id) }}">{{ $route->id }}</a></td>
                        <td>#{{ $route->from->id  }} - {{ $route->from->name }}</td>
                        <td>#{{ $route->to->id }} - {{ $route->to->name }}</td>
                        <td>{{ $route->distance_in_km }}</td>
                        <td>{{ $route->max_speed }}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1 class="has-text-centered">Намери най-краткият маршрут между два града</h1>
        <form action="{{ route('routes.search') }}" method="post">
            <div class="columns">
                @csrf
                @method('post')

                <div class="column is-one-third has-text-centered">
                    <h4 class="">
                        <label for="from">Начало</label>
                    </h4>
                    <div class="select is-primary is-small">
                        <select id="from" name="from" class="has-text-centered">
                            @foreach($towns as $town)
                                <option value="{{ $town->name }}" {{ ($from ?? '') === $town->name ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="column is-one-third has-text-centered">
                    <h4>
                        <label for="to">Край</label>
                    </h4>
                    <div class="select is-primary is-small">
                        <select id="to" name="to" class="has-text-centered">
                            @foreach($towns as $town)
                                <option value="{{ $town->name }}" {{ ($to ?? '') === $town->name ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="column is-one-third has-text-centered">
                    <button class="button is-info is-small" type="submit">Търси</button>
                </div>
            </div>
        </form>

        <div class="mt-3 has-text-centered">
            {{ $message ?? '' }}
        </div>

        <div class="mt-3 has-text-centered">
            @foreach($fullRouteInformation ?? [] as $directRouteGasStations)
                @foreach($directRouteGasStations ?? [] as $gasStation)
                    <div class="mt-0">{{ $gasStation ?? '' }}</div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
