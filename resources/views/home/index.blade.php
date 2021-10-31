@extends('layouts.master')

@section('title', 'Начало')

@section('content')
{{--    {{$_SERVER['SERVER_SOFTWARE']}}--}}
{{--    -----}}
{{--    {{$_SERVER['SERVER_PROTOCOL']}}--}}
{{--    -----}}
{{--    {{$_SERVER['REMOTE_ADDR']}}--}}
{{--    -----}}
{{--    {{$_SERVER['SERVER_NAME']}}--}}
{{--    -----}}
{{--    {{$_SERVER['PHP_SELF']}}--}}

    <div class="container">
        <section class="hero is-primary">
            <div class="hero-body">
                <p class="title">
                    Маршрути
                </p>
                <p class="subtitle">
                    Това е проект за маршрути, най-кратки пътища и т.н.
                    Още информация за проекта...
                    🚧
                </p>
            </div>
        </section>
    </div>

{{--    <img src="https://www.mapsinternational.co.uk/pub/media/catalog/product/x/w/o/world-wall-map-political-without-flags_wm00001_h.jpg" alt="">--}}

{{-- todo --}}
{{-- hero with image --}}
{{--<div class="hero is-fullheight is-primary has-background">--}}
{{--    <img alt="Fill Murray" class="hero-background is-transparent"--}}
{{--         src="https://www.mapsinternational.co.uk/pub/media/catalog/product/x/w/o/world-wall-map-political-without-flags_wm00001_h.jpg" />--}}
{{--    <div class="hero-body">--}}
{{--        <div class="container">--}}
{{--            <h1 class="title">--}}
{{--                Hero Image--}}
{{--            </h1>--}}
{{--            <h3 class="subtitle">--}}
{{--                without CSS background-image--}}
{{--            </h3>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@endsection
