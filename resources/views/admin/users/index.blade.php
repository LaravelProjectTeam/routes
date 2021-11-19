@extends('layouts.master')
<<<<<<< HEAD

@section('title', 'Всички потребители')
=======
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('title', 'Административен панел')
>>>>>>> origin/radi

@section('content')
    <div class="container has-text-centered">
        <h1 class="">@yield('title')</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>
                <th>Емайл</th>
                <th>Админ</th>
<<<<<<< HEAD
{{--                <th>Добави вид гориво</th>--}}
{{--                <th>Добави тип път</th>--}}
                <th>Създаден</th>
                <th>Обновен</th>
=======
                <th>Създаден на</th>
>>>>>>> origin/radi
                <th>Редактирай</th>
                <th>Изтрий</th>
{{--                <th>Запази</th>--}}
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
<<<<<<< HEAD
                        <td>{{ $user->admin == 0 ? 'Потребител' : 'Администратор' }}</td>
{{--                        <td>--}}
{{--                          <div class="has-text-centered">--}}
{{--                            <a href="{{route('admin.fuels.create')}}"><button type="submit" class="button is-info is-small">Добави</button></a>--}}
{{--                            <a href="{{route('admin.fuels.index')}}"><button type="submit" class="button is-warning is-small">Прегледай</button></a>--}}
{{--                          </div>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                          <div class="has-text-centered">--}}
{{--                            <a href="{{route('admin.road_types.create')}}"><button type="submit" class="button is-info is-small">Добави</button></a>--}}
{{--                            <a href="{{route('admin.road_types.index')}}"><button type="submit" class="button is-warning is-small">Прегледай</button></a>--}}
{{--                          </div>--}}
{{--                        </td>--}}
=======
                        <td>{{ $user->admin == 0 ? 'Потребител' : 'Админ' }}</td>
>>>>>>> origin/radi
                        <td> {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <td> {{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="select is-primary is-small m-1">
                                    <label for="admin">
                                        <select id="admin" name="admin" class="has-text-centered">
                                            <option value="1" {{ $user->admin ? 'selected' : '' }}>Администратор</option>
                                            <option value="0" {{ !$user->admin ? 'selected' : '' }}>Потребител</option>
                                        </select>
                                    </label>
                                </div>

                                <button type="submit" class="button is-success is-small m-1">Запази</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit" class="button is-danger is-small m-1">Изтрий</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="has-text-centered">
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
{{--            <a class="button is-warning is-small">Редактирай [ADMIN]</a>--}}
{{--            <a class="button is-danger is-small">Изтрий [ADMIN]</a>--}}
            <a href="{{route('admin.index')}}"><button type="submit" class="button is-info">Назад</button></a>
        </div>
        <span>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </span>
        <style type="text/css">
            .w-5{
                display: none;
            }
        </style>
    </div>
@endsection
