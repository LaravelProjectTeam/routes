@extends('layouts.master')

@section('title', $town->name)

@section('content')
    <div class="container">
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
                    <th>{{ $town->id }}</th>
                    <td>{{ $town->name }}</td>
                    <td>{{ $town->created_at->format('d.m.Y, H:i') }}</td>
                    <td>{{ $town->updated_at->format('d.m.Y, H:i') }}</td>
                    <td><a class="button is-warning is-small" href="{{ route('admin.towns.edit', $town->id) }}">Редактирай [ADMIN]</a></td>
                    <td>
                        <form action="{{ route('admin.towns.destroy', $town->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="button is-danger is-small" type="submit">Изтрий [ADMIN]</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-link is-small ml-2" href="{{ route('admin.towns.index') }}">Начало</a>
        </div>
    </div>
@endsection
