@extends('layouts.main')
@section('content')
<div class="container">
	<!-- <div class="table-responsive"> -->
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Наименование категории</th>
		      <th scope="col">Номер родительской категории</th>
              <th colspan="3" class="text-center">Действия</th>		      
		    </tr>
		  </thead>
		  <tbody>
@foreach($categories as $category)
		    <tr>
		      <th scope="row">{{ $category->id }}</th>
		      <td>{{ $category->name }}</td>
		      <td>{{ $category->parent_id }}</td>
              <td class="text-center"><a href="{{ route('category.show', $category->id) }}"><i class="bi bi-eye"></i>Открыть</a></td>
              <td class="text-center"><a href="{{ route('category.edit', $category->id) }}" class="text-success"></i>Редактировать</a></td>
              <td class="text-center">
              <form action="{{ route('category.delete', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="border-0 bg-transparent">
                  <i class="text-danger" role="button">Удалить</i>
              </button>
              </form>
              </td>		      
		    </tr>
@endforeach		      
		  </tbody>
		</table>
	<!-- </div> -->
</div>
@endsection