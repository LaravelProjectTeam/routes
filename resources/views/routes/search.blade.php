@extends('layouts.master')

@section('title', $result)

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Път</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $result ?? '' }}</td>
                </tr>
            </tbody>
        </table>
        {{--        todo: move in admin panel, users should not CRUD towns, only admins--}}
        <div class="buttons">
            <a class="button is-link is-small" href="{{ route('routes.index') }}">Начало</a>
        </div>
    </div>
@endsection
