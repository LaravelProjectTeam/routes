@extends('layouts.master')

@section('title', 'Администрация - Начало')

@section('content')
    <div class="container">
        <h1 class="ml-2">Администрация - Начало</h1>

        <a class="button is-primary is-small ml-2" href="{{ route('admin.towns.index') }}">Градове</a>
        <a class="button is-info is-small ml-2" href="{{ route('admin.filling_stations.index') }}">Бензиностанции</a>
        <a class="button is-danger is-small ml-2" href="{{ route('admin.fuels.index') }}">Горива</a>
        <a class="button is-secondary is-small ml-2" href="{{ route('admin.road_types.index') }}">Типове път</a>
        <a class="button is-warning is-small ml-2" href="{{ route('admin.users.index') }}">Потребители</a>

{{--        todo: implement direct route creating - from and to town--}}
        <h5>todo</h5>
        <ul>
            <li>- link to /admin/routes/index</li>
        </ul>
    </div>
@endsection



