@extends('layouts.admin.main')
@section('content')
    <section class="content">
        <div class="container">
            <div class="row">


                <form action = "{{ route('element.store') }}" method="POST" class="w-25">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Наименование">
                        @error('title')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="article" placeholder="Артикул">
                        @error('article')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="brand" placeholder="Бренд">
                        @error('brand')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="volume" placeholder="Объем">
                        @error('volume')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="count" placeholder="Количество">
                        @error('count')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="description" placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <input type="currency" class="form-control" name="price" placeholder="Цена">
                        @error('price')
                            <div class="text-danger">Это поле необходимо для заполнения</div>
                        @enderror
                    </div>
                    <div class="form-group w-50">
                        <label>Выберите категорию</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
