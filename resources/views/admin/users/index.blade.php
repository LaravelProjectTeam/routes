@extends('layouts.master')

@section('title', 'Всички потребители')

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
                <th>Създаден</th>
                <th>Обновен</th>
                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->admin == 0 ? 'Потребител' : 'Администратор' }}</td>
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

        <div class="mb-5">
            {{ $users->links() }}
        </div>

        <div class="has-text-centered">
            <a class="button is-info is-small" href="{{ route('admin.index') }}">Назад</a>
        </div>
    </div>
@endsection
