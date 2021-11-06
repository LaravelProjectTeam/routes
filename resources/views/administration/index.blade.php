@extends('layouts.master')

@section('title', 'Административен панел')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички градове</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Емайл</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{--        todo: move in admin panel, users should not CRUD towns, only admins--}}
        <div class="buttons">
            <!-- <a class="button is-primary is-small ml-2" href="{{ route('towns.create') }}">Създай [ADMIN]</a> -->
{{--            <a class="button is-warning is-small">Редактирай [ADMIN]</a>--}}
{{--            <a class="button is-danger is-small">Изтрий [ADMIN]</a>--}}
        </div>
    </div>
@endsection
