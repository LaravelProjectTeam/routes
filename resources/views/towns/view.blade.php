@extends('layouts.master')

@section('title', $town->name)

@section('content')
    <div class="container has-text-centered">
        <h1>@yield('title')</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Създаден на</th>
                <th>Обновен на</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{ $town->id }}</th>
                    <td>{{ $town->name }}</td>
                    <td>{{ isset($town->created_at) ? $town->created_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                    <td>{{ isset($town->updated_at) ? $town->updated_at->format('d.m.Y, H:i') : 'Няма информация.' }}</td>
                </tr>
            </tbody>
        </table>
        <div class="has-text-centered">
            <a class="button is-link is-small " href="{{ route('towns.index') }}">Назад</a>
        </div>
    </div>
@endsection
