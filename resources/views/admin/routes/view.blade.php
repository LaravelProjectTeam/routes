@extends('layouts.master')

@section('title', $route->from->name . ' - ' . $route->to->name)

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>От град</th>
                    <th>Минава през </th>
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
                <tr>
                    <td>{{ $route->id }}</td>
                    <td>#{{ $route->from->id  }} - {{ $route->from->name }}</td>
                    <td>... минава през тези ...</td>
                    <td>#{{ $route->to->id }} - {{ $route->to->name }}</td>
                    <td>{{ $route->minutes_needed }}</td>
                    <td>{{ $route->type->name }}</td>
                    <td>{{ $route->created_at->format('d.m.Y, H:i') }}</td>
                    <td>{{ $route->updated_at->format('d.m.Y, H:i') }}</td>
                    <td><a class="button is-warning is-small" href="{{ route('routes.edit', $route->id) }}">Редактирай [ADMIN]</a></td>
                    <td>
                        <form action="{{ route('routes.destroy', $route->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger is-small" type="submit">Изтрий [ADMIN]</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-link is-small" href="{{ route('routes.index') }}">Начало</a>
        </div>
    </div>
@endsection
