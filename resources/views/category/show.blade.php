@extends('layouts.main')
@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-6">
            Категории
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tbody>
                    <tr>
                      <td>ID</td>
                      <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                      <td>Название</td>
                      <td>{{ $category->name }}</td>
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