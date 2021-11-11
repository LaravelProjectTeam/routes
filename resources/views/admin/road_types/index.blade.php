@extends('layouts.master')

@section('title', 'Пътища')

@section('content')
<h1 class="ml-2">Всички типове пътища</h1>
<table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Тип път</th>
                <th>Трудност</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->hardship_level }}</td>
                        <td>{{date('d-m-Y', strtotime($type->created_at))}}</td>
                        <td>
                            <a href="{{ route('admin.road_types.edit', $type->id) }}">
                                <button type="submit" class="button is-warning">Редактирай</button>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.road_types.destroy', $type->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="button is-danger">Изтрий
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
</table>
<a href="{{route('admin.road_types.create')}}"><button type="submit" class="button is-success">Създай</button></a>
<a href="{{route('admin.index')}}"><button type="submit" class="button is-info">Назад</button></a>
@endsection