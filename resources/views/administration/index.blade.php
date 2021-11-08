@extends('layouts.master')

@section('title', 'Административен панел')

@section('content')
    <div class="container">
        <h1 class="ml-2">Всички потребители</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Име</th>

                <th>Емайл</th>
                <th>Създаден на</th>

                <th>Редактирай</th>
                <th>Изтрий</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>

                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>


                        
                        <td>
                            <div class="dropdown is-hoverable">
                              <div class="dropdown-trigger">
                                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu4">
                                  <span><?= $user->admin == 1 ? 'admin' : 'user' ?></span>
                                  <span class="icon is-small">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                  </span>
                                </button>
                              </div>
                              <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                <div class="dropdown-content">
                                  <div class="dropdown-item">
                                    <p>You can insert <strong>any type of content</strong> within the dropdown menu.</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="button is-danger"> Delete </button>
                            </form>
                        </td>
                        

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{--        todo: move in admin panel, users should not CRUD towns, only admins--}}
        <div class="buttons">
            <!-- <a class="button is-primary is-small ml-2" href="{{ route('towns.create') }}">Създай [ADMIN]</a> -->
{{--            <a class="button is-warning is-small">Редактирай [ADMIN]</a>--}}
{{--            <a class="button is-danger is-small">Изтрий [ADMIN]</a>--}}
        </div>
    </div>
@endsection
