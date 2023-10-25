@extends('layouts.main')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-6">
            Товар
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tbody>
                    <tr>
                      <td>ID</td>
                      <td>{{ $element->id }}</td>
                    </tr>
                    <tr>
                      <td>Название</td>
                      <td>{{ $element->title }}</td>
                    </tr>
                    <tr>
                      <td>Артикул</td>
                      <td>{{ $element->article }}</td>
                    </tr>
                    <tr>
                      <td>Бренд</td>
                      <td>{{ $element->brand }}</td>
                    </tr>
                    <tr>
                      <td>ОБъем</td>
                      <td>{{ $element->volume }}</td>
                    </tr>
                    <tr>
                      <td>Описание</td>
                      <td>{{ $element->description }}</td>
                    </tr>
                    <tr>
                      <td>Цена</td>
                      <td>{{ $element->price }}</td>
                    </tr>                                                             
                  </tbody>
                </table>
              </div>    
          </div>
        
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
@endsection    