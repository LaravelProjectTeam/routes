@extends('layouts.master')

@section('title', 'Всички пътища')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>До град ИД</th>
                    <th>От град ИД</th>
                    <th>Нужни минути</th>
                    <th>Създаден на</th>
                    <th>Обновен на</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    <tr>
                        <th>{{ $route->id }}</th>
                        <td>{{ $route->to_node_id }}</td>
                        <td>{{ $route->from_node_id }}</td>
                        <td>{{ $route->minutes_needed }}</td>
                        <td>{{ $route->created_at }}</td>
                        <td>{{ $route->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
