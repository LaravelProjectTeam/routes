@extends('layouts.master')

@section('title', 'Администрация - Начало')

@section('content')
    <div class="container">
        <h1 class="ml-2">Администрация - Начало</h1>

        <a class="button is-primary is-small ml-2" href="{{ route('admin.towns.index') }}">Градове</a>
        <a class="button is-info is-small ml-2" href="{{ route('admin.filling_stations.index') }}">Бензиностанции</a>
{{--        <a class="button is-primary is-small ml-2" href="{{ route('users.admin.index') }}">Градове</a>--}}

{{--        todo: implement direct route creating - from and to town--}}
        <h5>todo</h5>
        <ul>
            <li>implement direct route creating - from and to</li>
            <li>link to /admin/users/index</li>
            <li>link to /admin/fuels/index</li>
            <li>link to /admin/types/index</li>
            <li>link to /admin/routes/index</li>
        </ul>
    </div>
@endsection



