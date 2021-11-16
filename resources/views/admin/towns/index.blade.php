@extends('layouts.master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('title', 'Всички градове')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички градове</h1>

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
                @foreach($towns as $town)
                    <tr>
                        <th>{{ $town->id }}</th>
                        <td><a href="{{ route('admin.towns.show', $town->id) }}">{{ $town->name }}</a></td>
                        <td>{{ isset($town->created_at) ? $town->created_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td>{{ isset($town->updated_at) ? $town->updated_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td><a class="button is-warning is-small" href="{{ route('admin.towns.edit', $town->id) }}">Редактирай</a></td>
                        <td>
                            <form action="{{ route('admin.towns.destroy', $town->id) }}" method="post">
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
            <a class="button is-primary ml-2" href="{{ route('admin.towns.create') }}">Създай</a>
            <a href="{{route('admin.index')}}"><button type="submit" class="button is-info">Назад</button></a>
        </div>
        <span>
            <div class="d-flex justify-content-center">
                {{ $towns->links() }}
            </div>
        </span>
        <style type="text/css">
            .w-5{
                display: none;
            }
        </style>
    </div>
@endsection
