@extends('layouts.main')
@section('content')
    <section class="content">
      <div class="container">
        <div class="row">

           
            <form action = "{{ route('category.store') }}" method="POST" class="w-25">
            @csrf
              <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Название категории">
                    @error('name')
                        <div class="text-danger">Это поле необходимо для заполнения</div>
                    @enderror
              </div>
              <div class="form-group w-50">
                <label>Выберите категорию</label>
                    <select name="parent_id" class="form-control">
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}"
                      {{ $category->id == old('category_id') ? ' selected' : '' }}
                      >{{ $category->name }}</option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror                     
              </div>
                    <input type="submit" class="btn btn-primary" value="Добавить">
            </form>    
          </div>
        
      </div>
    </section>
@endsection        