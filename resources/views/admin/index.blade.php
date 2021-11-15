@extends('layouts.master')

@section('title', 'Администрация')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Admin View</div>--}}

{{--                <div class="card-body">--}}
{{--                  Welcome to admin dashboard--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

    <div class="container">
        <h1 class="ml-2">@yield('title')</h1>
        <a class="button is-primary is-small ml-2 mt-2" href="{{ route('admin.towns.index') }}">Градове</a>
        <a class="button is-info is-small ml-2 mt-2" href="{{ route('admin.filling_stations.index') }}">Бензиностанции</a>
        <a class="button is-danger is-small ml-2 mt-2" href="{{ route('admin.fuels.index') }}">Горива</a>
        <a class="button is-secondary is-small ml-2 mt-2" href="{{ route('admin.road_types.index') }}">Типове път</a>
        <a class="button is-warning is-small ml-2 mt-2" href="{{ route('admin.users.index') }}">Потребители</a>
        <a class="button is-link is-small ml-2 mt-2" href="{{ route('admin.routes.index') }}">Пътища</a>
    </div>
@endsection



