@extends('layouts.master')

@section('title', 'Всички горива')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички горива</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Вид гориво</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
            @foreach($fuels as $fuel)
                <tr>
                    <td>{{ $fuel->id }}</td>
                    <td>{{ $fuel->name }}</td>
                    <td>{{date('d-m-Y', strtotime($fuel->created_at))}}</td>
                    <td>
                        <a href="{{ route('admin.fuels.edit', $fuel->id) }}">
                            <button type="submit" class="button is-small is-warning">Редактирай</button>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.fuels.destroy', $fuel->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="button is-small is-danger">Изтрий</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-small is-success" href="{{route('admin.fuels.create')}}">Създай</a>
            <a class="button is-small is-info" href="{{route('admin.index')}}">Назад</a>
        </div>
    </div>
@endsection
