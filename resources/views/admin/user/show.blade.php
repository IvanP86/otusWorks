@extends('layouts.admin.main')
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
                      <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                      <td>Имя</td>
                      <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                      <td>Электронный адрес</td>
                      <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                      <td>Права</td>
                      <td>{{ $user->role->title }}</td>
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