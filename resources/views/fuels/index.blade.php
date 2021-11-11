@extends('layouts.master')

@section('title', 'Горива')

{{--todo: add admin. prefix to route--}}
@section('content')
<h1 class="ml-2">Всички горива</h1>
<table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Вид гориво</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($fuels as $fuel)
                    <tr>
                        <td>{{ $fuel->id }}</td>
                        <td>{{ $fuel->name }}</td>
                        <td>{{date('d-m-Y', strtotime($fuel->created_at))}}</td>
                        <td><a href="{{ route('fuels.edit', $fuel->id) }}"><button type="submit" class="button is-warning">Редактирай</button></a></td>
                        <td>
                            <form action="{{ route('fuels.destroy', $fuel->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="button is-danger">Изтрий
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
</table>
<a href="{{route('users.index')}}"><button type="submit" class="button is-info">Назад</button></a>
@endsection
