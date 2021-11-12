@extends('layouts.master')

@section('title', 'Всички бензиностанции')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички бензиностанции</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Създаден на</th>
                <th>Обновен на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($filling_stations as $filling_station)
                    <tr>
                        <th>{{ $filling_station->id }}</th>
                        <td><a href="{{ route('admin.filling_stations.show', $filling_station->id) }}">{{ $filling_station->name }}</a></td>
                        <td>{{ isset($filling_station->created_at) ? $filling_station->created_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td>{{ isset($filling_station->updated_at) ? $filling_station->updated_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td><a class="button is-warning is-small" href="{{ route('admin.filling_stations.edit', $filling_station->id) }}">Редактирай</a></td>
                        <td>
                            <form action="{{ route('admin.filling_stations.destroy', $filling_station->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="button is-danger is-small" type="submit">Изтрий</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="buttons">
            <a class="button is-primary is-small ml-2" href="{{ route('admin.filling_stations.create') }}">Създай</a>
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
        </div>
    </div>
@endsection
