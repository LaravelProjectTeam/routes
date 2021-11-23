@extends('layouts.master')

@section('title', 'Всички градове')

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
                @foreach($towns as $town)
                    <tr>
                        <th>{{ $town->id }}</th>
                        <td><a href="{{ route('towns.show', $town->id) }}">{{ $town->name }}</a></td>
                        <td>{{ isset($town->created_at) ? $town->created_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td>{{ isset($town->updated_at) ? $town->updated_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-5">
            {{ $towns->links() }}
        </div>

    </div>
@endsection
