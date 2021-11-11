@extends('layouts.master')

@section('title', $filling_station->name)

@section('content')
    <div class="container">
        <h1 class="ml-2">{{ $filling_station->name }}</h1>

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
                <tr>
                    <th>{{ $filling_station->id }}</th>
                    <td>{{ $filling_station->name }}</td>
                    <td>{{ isset($filling_station->created_at) ? $filling_station->created_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                    <td>{{ isset($filling_station->created_at) ? $filling_station->updated_at->format('d.m.Y, H:i') : 'Няма информация.'}}</td>
                    <td><a class="button is-warning is-small" href="{{ route('admin.filling_stations.edit', $filling_station->id) }}">Редактирай</a></td>
                    <td>
                        <form action="{{ route('admin.filling_stations.destroy', $filling_station->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger is-small" type="submit">Изтрий</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-link is-small ml-2" href="{{ route('admin.filling_stations.index') }}">Начало</a>
        </div>
    </div>
@endsection
