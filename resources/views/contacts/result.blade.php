@extends('layouts.master')

@section('title', 'Контакти')

@section('content')
    <div class="container has-text-centered">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="mt-3">Контакти</h1>
                @if ($status_code === 202)
                    <p>Вашето съобщение беше изпратено успешно!</p>
{{--                @elseif($status_code === 401)--}}
                @else
                    <p>Възникна грешка!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
