@extends('layouts.master')

@section('title', 'Всички пътища')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички директни пътища</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>От град</th>
                    <th>До град</th>
                    <th>Нужни минути</th>
                    <th>Вид</th>
                    <th>Създаден на</th>
                    <th>Обновен на</th>
{{--                    <th>Редактирай</th>--}}
{{--                    <th>Изтрий</th>--}}
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td><a href="{{ route('routes.show', $route->id) }}">{{ $route->id }}</a></td>
                        <td>#{{ $route->from->id  }} - {{ $route->from->name }}</td>
                        <td>#{{ $route->to->id }} - {{ $route->to->name }}</td>
                        <td>{{ $route->minutes_needed }}</td>
                        <td>{{ $route->type->name }}</td>
                        <td>{{ $route->created_at }}</td>
                        <td>{{ $route->updated_at }}</td>
{{--                        <td><a class="button is-warning is-small" href="{{ route('routes.edit', $route->id) }}">Редактирай [ADMIN]</a></td>--}}
{{--                        <td>--}}
{{--                            <form action="{{ route('routes.destroy', $route->id) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="button is-danger is-small" type="submit">Изтрий [ADMIN]</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1 class="ml-2">Намери най-краткият маршрут между два града</h1>
        <form action="{{ route('routes.search') }}" method="post">
            <div class="columns">
                @csrf
                @method('post')

                <div class="column is-one-third">
                    <h4 class="ml-2">
                        <label for="from">Начало</label>
                    </h4>
                    <div class="select is-small ml-2">
                        <select id="from" name="from" >
                            @foreach($towns as $town)
                                <option value="{{ $town->name }}" {{ ($from ?? '') === $town->name ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="column is-one-third">
                    <h4 class="ml-2">
                        <label for="to">Край</label>
                    </h4>
                    <div class="select is-small ml-2">
                        <select id="to" name="to">
                            @foreach($towns as $town)
                                <option value="{{ $town->name }}"{{ ($to ?? '') === $town->name ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="column is-one-third ml-2">
                    <button class="button is-info is-small" type="submit">Търси</button>
                </div>
            </div>
        </form>

        <div class="mt-2 ml-2">
            {{ $message ?? '' }}
        </div>
    </div>
@endsection
