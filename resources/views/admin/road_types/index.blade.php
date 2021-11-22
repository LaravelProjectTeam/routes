@extends('layouts.master')

@section('title', 'Всички типове пътища')

@section('content')
    <div class="container has-text-centered">
        <h1>@yield('title')</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Тип път</th>
                    <th>Трудност</th>
                    <th>Създаден на</th>
                    <th>Обновен на</th>
                    <th>Редактирай</th>
                    <th>Изтрий</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <th>{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->hardship_level }}</td>
                        <td>{{date('d-m-Y', strtotime($type->created_at))}}</td>
                        <td>{{date('d-m-Y', strtotime($type->updated_at))}}</td>
                        <td>
                            <a href="{{ route('admin.road_types.edit', $type->id) }}">
                                <button type="submit" class="button is-warning is-small">Редактирай</button>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.road_types.destroy', $type->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit" class="button is-danger is-small">Изтрий</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="has-text-centered">
            <a class="button is-small is-success" href="{{route('admin.road_types.create')}}">Създай</a>
            <a class="button is-small is-info" href="{{route('admin.index')}}">Назад</a>
        </div>
    </div>
@endsection
