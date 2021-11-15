@extends('layouts.master')

@section('title', 'Създай директен път между два града')

@section('content')
    <div class="container">
        <h1 class="ml-2">Текущи директни пътища</h1>
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
            @foreach($routes as $route)
                <tr>
                    <td><a href="{{ route('admin.routes.show', $route->id) }}">{{ $route->id }}</a></td>
                    <td>#{{ $route->from->id  }} - {{ $route->from->name }}</td>
                    <td>#{{ $route->to->id }} - {{ $route->to->name }}</td>
                    <td>{{ $route->distance_in_km }}</td>
                    <td>{{ $route->max_speed }}</td>
                    {{--                        <td>{{ dd($route->filling_stations) }}</td>--}}
                    {{--                        <td>{{ $route->minutes_needed }}</td>--}}
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
                            @method('DELETE')
                            <button class="button is-danger is-small" type="submit">Изтрий</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="columns is-mobile is-centered mt-2">
            <div class="column is-half">
                <h1 class="ml-2">@yield('title')</h1>

                <form action="{{ route('admin.routes.store') }}" method="post">
                    @csrf
                    @method('post')

                    <div class="columns">
                        <div class="column is-one-third">
                            <h4 class="mt-3">
                                <label for="from_node_id">Начало</label>
                            </h4>
                            <div class="select is-small">
                                <select id="from_node_id" name="from_node_id" >
                                    @foreach($towns ?? [] as $town)
                                        <option
                                            value="{{ $town->id }}"
                                            {{ (
                                                session('swapped') ?
                                                old('to_node_id') :
                                                old('from_node_id')
                                               ) == $town->id ? 'selected' : ''
                                            }}>
                                            {{ $town->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="column is-one-third">
                            <h4 class="mt-3">
                                <label for="to_node_id">Край</label>
                            </h4>
                            <div class="select is-small">
                                <select id="to_node_id" name="to_node_id">
                                    @foreach($towns ?? [] as $town)
                                        <option
                                            value="{{ $town->id }}"
                                            {{ (
                                                session('swapped') ?
                                                old('from_node_id') :
                                                old('to_node_id')
                                               ) == $town->id ? 'selected' : ''
                                            }}>
                                            {{ $town->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                   @if ($errors->get('to_node_id') )
                       <p class="help is-danger">
                           {{ $errors->toArray()['to_node_id'][0] }}
                       </p>
                   @elseif ($errors->get('from_node_id'))
                       <p class="help is-danger">
                           {{ $errors->toArray()['from_node_id'][0] }}
                       </p>
                   @endif

{{--                    debug only --}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <p class="help is-danger">--}}
{{--                            {{ $error }}<br/>--}}
{{--                        </p>--}}
{{--                    @endforeach--}}

                    <div class="buttons mt-2">
                        <button class="button is-small is-success" type="submit" >Запиши</button>
                        <a class="button is-link is-small" href="{{ route('admin.towns.index') }}">Откажи</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
