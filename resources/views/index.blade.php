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
		    <tr>
		      <th scope="row">1</th>
		      <td>111</td>
		      <td>Товар1</td>
		      <td>100</td>
		      <td><a type="button" href="#" class="btn btn-primary">В корзину</a></td>
		    </tr>
		    <tr>
		      <th scope="row">2</th>
		      <td>222</td>
		      <td>Товар2</td>
		      <td>100</td>
		      <td><a type="button" href="#" class="btn btn-primary">В корзину</a></td>
		    </tr>
		    <tr>
		      <th scope="row">3</th>
		      <td>333</td>
		      <td>Товар3</td>
		      <td>100</td>
		      <td><a type="button" href="#" class="btn btn-primary">В корзину</a></td>
		    </tr>
		  </tbody>
		</table>
	</div>
@endif		
</div>
@endsection