@extends('layouts.master')

@section('title', 'Всички градове')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички градове</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Създаден на</th>
                <th>Обновен на</th>
            </tr>
            </thead>
            <tbody>
                @foreach($towns as $town)
                    <tr>
                        <th>{{ $town->id }}</th>
                        <td><a href="{{ route('towns.show', $town->id) }}">{{ $town->name }}</a></td>
                        <td>{{ isset($town->created_at) ? $town->created_at->format('d.m.Y, H:i') : "Няма информация." }}</td>
                        <td>{{ isset($town->updated_at) ? $town->updated_at->format('d.m.Y, H:i') : "Няма информация." }}</td>

{{--                        todo: should not be possible, test out later--}}
{{--                        <td><a class="button is-warning is-small" href="{{ route('towns.edit', $town->id) }}">Редактирай</a></td>--}}
                        {{--                        <td>--}}
{{--                            <form action="{{ route('towns.destroy', $town->id) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="button is-danger is-small" type="submit">Изтрий</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <span>
            {{$towns->links()}}   
        </span>
        <style type="text/css">
            .w-5{
                display: none;
            }
        </style>

{{--                        todo: should not be possible, test out later--}}
{{--        <div class="buttons">--}}
{{--            <a class="button is-primary is-small ml-2" href="{{ route('towns.create') }}">Създай</a>--}}
{{--        </div>--}}
    </div>
@endsection
