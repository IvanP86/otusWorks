@extends('layouts.admin.main')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <div class="col-12">

                    <form action = "{{ route('element.update', $element->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="title" placeholder="Название"
                                value="{{ $element->title }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="article" placeholder="Артикул"
                                value="{{ $element->article }}">
                            @error('article')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="brand" placeholder="Бренд"
                                value="{{ $element->brand }}">
                            @error('brand')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <input type="numeric" class="form-control" name="volume" placeholder="Объем"
                                value="{{ $element->volume }}">
                            @error('volume')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <input type="text" class="form-control" name="description" placeholder="Описание"
                                value="{{ $element->description }}">
                        </div>
                        <div class="form-group w-25">
                            <input type="numeric" class="form-control" name="count" placeholder="Количество"
                                value="{{ $element->count }}">
                            @error('count')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <input type="currency" class="form-control" name="price" placeholder="Цена"
                                value="{{ $element->price }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-25">
                            <label>Выберите категорию</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $loopCategory)
                                    <option value="{{ $loopCategory->id }}"
                                        {{ $loopCategory->id == $element->category_id ? ' selected' : '' }}>
                                        {{ $loopCategory->name }}</option>
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
