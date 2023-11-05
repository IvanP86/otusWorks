@extends('layouts.main')
@section('content')
<div class="container">
	<label for="search" class="form-label">Поиск</label>
	<div class="input-group">
        <input type="search" class="form-control rounded" placeholder="Искать..." aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary">Искать</button>
    </div>
	<div id="searchHelpBlock" class="form-text">
	    Введите наименование интересующего Вас товара
	</div>

@php($searchResult = true)
@if ($searchResult)
	<div class="table-responsive">
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Артикул</th>
		      <th scope="col">Наименование</th>
		      <th scope="col">Цена</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody>
@foreach($elements as $element)
		    <tr>
		      <th scope="row">{{ $element->id }}</th>
		      <td>{{ $element->article }}</td>
		      <td><a href="{{ route('show', $element->id) }}"/> {{ $element->title }} </td>
		      <td>{{ $element->price }}</td>
		      <td><a type="button" href="#" class="btn btn-primary">В корзину</a></td>
		    </tr>
@endforeach
		  </tbody>
		</table>
	</div>
@endif		
</div>
@endsection