@extends('layouts.admin.main')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Права</th>
                    <th colspan="3" class="text-center">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if (isset($user))
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->title }}</td>
                            <td class="text-center"><a href="{{ route('user.show', $user->id) }}"><i
                                        class="bi bi-eye"></i>Открыть</a></td>
                            <td class="text-center"><a href="{{ route('user.edit', $user->id) }}"
                                    class="text-success"></i>Редактировать</a></td>
                            <td class="text-center">
                                <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent">
                                        <i class="text-danger" role="button">Удалить</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <!-- </div> -->
    </div>
@endsection
