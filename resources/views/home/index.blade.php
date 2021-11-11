@extends('layouts.master')

@section('title', 'Начало')

@section('content')
    <div class="container">
        <section class="hero is-primary">
            <div class="hero-body">
                <p class="title">
                    {{ 'Маршрути' }}
                </p>
                <p class="subtitle">
                    {{
                        'Това е проект, който по зададени начална и крайна дестинация описва най-краткият възможен маршрут
                        между двете точки, както и нужното време за пътуването ви. Предоствя се и информация за
                        бензиностанциите, на които може да заредите и горивата, които те предлагат.'
                    }}
                </p>
            </div>
        </section>

        <img src="https://i.redd.it/uoprbjfqqyp31.png" alt="splash-screen">
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

