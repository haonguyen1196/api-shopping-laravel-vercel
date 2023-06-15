@extends('layouts.admin')

@section('title','User')

@section('content')

@section('js')
  <script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
  <script src="{{ asset('admins/main.js')}}"></script>
@endsection
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'User', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('admin.user.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="{{ route('admin.user.edit', [ 'id' => $user->id ]) }}" class="btn btn-default">Edit</a>
                          <a href="" data-url="{{ route('admin.user.delete', [ 'id' => $user->id ] ) }}" class="btn btn-danger active_delete">Delete</a>
                        </td>
                      </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            {{ $users->links('pagination::bootstrap-4')}}
          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

