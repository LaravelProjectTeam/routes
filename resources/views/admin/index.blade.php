@extends('layouts.master')

@section('title', 'Администрация')

@section('content')
{{--<div class="container has-text-centered">--}}
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

    <div class="container has-text-centered">
        <h1 class="">@yield('title')</h1>
        <a class="button is-primary is-small  mt-2" href="{{ route('admin.towns.index') }}">Градове</a>
        <a class="button is-info is-small  mt-2" href="{{ route('admin.filling_stations.index') }}">Бензиностанции</a>
        <a class="button is-danger is-small  mt-2" href="{{ route('admin.fuels.index') }}">Горива</a>
        <a class="button is-secondary is-small  mt-2" href="{{ route('admin.road_types.index') }}">Типове път</a>
        <a class="button is-warning is-small  mt-2" href="{{ route('admin.users.index') }}">Потребители</a>
        <a class="button is-link is-small  mt-2" href="{{ route('admin.routes.index') }}">Пътища</a>
    </div>
@endsection



