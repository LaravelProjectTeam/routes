@extends('layouts.master')

@section('title', 'Всички градове')

@section('content')
    <div class="container">
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
                        <td>{{ $town->name }}</td>
                        <td>{{ $town->created_at }}</td>
                        <td>{{ $town->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
