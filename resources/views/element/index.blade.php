@extends('layouts.admin.main')
@section('content')
<div class="container">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Наименование</th>
		      <th scope="col">Артикул</th>
			  <th scope="col">Бренд</th>
			  <th scope="col">Объем</th>
			  <th scope="col">Количество</th>
			  <th scope="col">Цена</th>
              <th colspan="3" class="text-center">Действия</th>		      
		    </tr>
		  </thead>
		  <tbody>
@foreach($elements as $element)
		    <tr>
		      <th scope="row">{{ $element->id }}</th>
		      <td>{{ $element->title }}</td>
		      <td>{{ $element->article }}</td>
			  <td>{{ $element->brand }}</td>
			  <td>{{ $element->volume }}</td>
			  <td>{{ $element->count }}</td>
			  <td>{{ $element->price }}</td>
              <td class="text-center"><a href="{{ route('element.show', $element->id) }}"><i class="bi bi-eye"></i>Открыть</a></td>
              <td class="text-center"><a href="{{ route('element.edit', $element->id) }}" class="text-success"></i>Редактировать</a></td>
              <td class="text-center">
              <form action="{{ route('element.delete', $element->id) }}" method="POST">
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