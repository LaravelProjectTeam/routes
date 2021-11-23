@extends('layouts.master')

@section('title', $route->from->name . ' - ' . $route->to->name)

@section('content')
    <div class="container has-text-centered">
        <h1>@yield('title') 123</h1>
        asdasas
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
                    <td><a class="button is-warning is-small" href="{{ route('routes.edit', $route->id) }}">Редактирай</a></td>
                    <td>
                        <form action="{{ route('routes.destroy', $route->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="button is-danger is-small" type="submit">Изтрий</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="has-text-centered">
            <a class="button is-link is-small" href="{{ route('routes.index') }}">Начало</a>
        </div>
    </div>
@endsection
