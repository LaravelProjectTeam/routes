@extends('layouts.master')

@section('title', 'Пътища')

@section('content')
<h1 class="ml-2">Всички типове пътища</h1>
<table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Тип път</th>
                <th>Трудност</th>
                <th>Създаден на</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->hardship_level }}</td>
                        <td>{{date('d-m-Y', strtotime($type->created_at))}}</td>
                        <td><a href="{{ route('types.edit', $type->id) }}"><button type="submit" class="button is-warning">Редактирай</button></a></td>
                        <td>
                            <form action="{{ route('types.destroy', $type->id) }}" method="post">
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