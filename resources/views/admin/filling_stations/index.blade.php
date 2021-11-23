@extends('layouts.master')

@section('title', 'Всички бензиностанции')

@section('content')
    <div class="container has-text-centered">
        <h1>@yield('title')</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Име</th>
                    <th>Горива</th>
                    <th>Път</th>
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
                        <td>
                            {{
                                $filling_station->fuels->count() ?
                                join(', ', $filling_station->fuels->pluck('name')->toArray()) :
                                'няма горива'
                            }}
                        </td>
                        <td>
                            {{ $filling_station->road->from->name }}
                            -
                            {{ $filling_station->road->to->name }} |
                            {{ $filling_station->road->minutes_needed }} минути |
                            {{ $filling_station->road->roadType->name }} път
                        </td>
                        <td>{{ isset($filling_station->created_at) ? $filling_station->created_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td>{{ isset($filling_station->updated_at) ? $filling_station->updated_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td><a class="button is-warning is-small" href="{{ route('admin.filling_stations.edit', $filling_station->id) }}">Редактирай</a></td>
                        <td>
                            <form action="{{ route('admin.filling_stations.destroy', $filling_station->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="button is-danger is-small" type="submit">Изтрий</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-5">
            {{ $filling_stations->links() }}
        </div>

        <div class="has-text-centered">
            <a class="button is-primary is-small " href="{{ route('admin.filling_stations.create') }}">Създай</a>
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
        </div>

    </div>
@endsection
