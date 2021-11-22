@extends('layouts.master')

@section('title', 'Начало')

@section('content')
    <div class="container has-text-centered">
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

{{--        'https://routesbg.blob.core.windows.net/routesbg-container/splash-screen.png'--}}
{{--        <img src="https://i.redd.it/uoprbjfqqyp31.png" alt="splash-screen">--}}
        <img src="{{ asset('storage/images/splash-screen.png') }}" alt="splash-screen">
    </div>
@endsection

