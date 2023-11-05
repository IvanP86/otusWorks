@extends('layouts.admin.main')
@section('content')
    <section class="content">
        <div class="container">
            <div class="row">


                <form action = "{{ route('user.store') }}" method="POST" class="w-25">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Имя">
                        @error('name')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Электронная почта">
                        @error('email')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="password" placeholder="Пароль">
                        @error('password')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>


                    <div class="form-group w-50">
                        <label>Выберите категорию</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary" value="Добавить">
                </form>
            </div>

        </div>
    </section>
@endsection
