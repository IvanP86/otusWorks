@extends('layouts.admin.main')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-12">
           
            <form action = "{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
              <div class="form-group w-25">
                    <input type="text" class="form-control" name="name" placeholder="Название категории" value="{{ $category->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>
              <div class="form-group w-25">
                <label>Выберите категорию</label>
                    <select name="parent_id" class="form-control">
                    @foreach($categories as $loopCategory)
                      <option value="{{ $loopCategory->id }}"
                      {{ $category->parent_id == $loopCategory->id ? ' selected' : '' }}
                      >{{ $loopCategory->id }}</option>
                    @endforeach
                    </select>
                    @error('parent_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror                    
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