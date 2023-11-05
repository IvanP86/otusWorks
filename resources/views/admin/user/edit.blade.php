@extends('layouts.admin.main')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-12">
           
            <form action = "{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
              <div class="form-group w-25">
                    <input type="text" class="form-control" name="name" placeholder="Имя" value="{{ $user->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>
              <div class="form-group w-25">
                    <input type="text" class="form-control" name="email" placeholder="Емейл" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>
              <div class="form-group w-25">
                    <input type="password" class="form-control" name="password" placeholder="Пароль" value="{{ $user->password }}">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>

                           
              <div class="form-group w-25">
                <label>Выберите права</label>
                    <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                      <option value="{{ $role->id }}"
                      {{ $role->id == $user->role->id ? ' selected' : '' }}
                      >{{ $role->title }}</option>
                    @endforeach
                    </select>
              </div>
              <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Обновить">
              </div>
            </form>    
          </div>
        
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
  @endsection