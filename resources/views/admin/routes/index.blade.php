@extends('layouts.master')

@section('title', 'Администрация | Всички директни пътища')

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
                    <th>Редактирай</th>
                    <th>Изтрий</th>
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
                        <td>{{ isset($route->created_at) ? $route->created_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                        <td>{{ isset($route->updated_at) ? $route->updated_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                        <td><a class="button is-warning is-small" href="{{ route('admin.routes.edit', $route->id) }}">Редактирай</a></td>
                        <td>
                            <form action="{{ route('admin.routes.destroy', $route->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button is-danger is-small" type="submit">Изтрий [ADMIN]</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 ml-2">
            @foreach($full_route_information ?? [] as $full_direct_route_info)
                <div class="mt-0">{{ $full_direct_route_infon ?? '' }}</div>
            @endforeach
        </div>

        <div class="buttons mt-3">
                <a class="button is-success is-small" href="{{ route('admin.routes.create') }}">Създай</a>
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
        </div>
    </div>
@endsection
