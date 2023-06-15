@extends('layouts.admin')

@section('title','Role')

@section('content')

@section('js')
  <script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
  <script src="{{ asset('admins/main.js')}}"></script>
@endsection
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Role', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('admin.role.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên vai trò</th>
                    <th scope="col">Mô tả vai trò</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach($roles as $role)
                      <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                          <a href="{{ route('admin.role.edit', [ 'id' => $role->id ]) }}" class="btn btn-default">Edit</a>
                          <a href="" data-url="{{ route('admin.role.delete', [ 'id' => $role->id ])}}" class="btn btn-danger active_delete">Delete</a>
                        </td>
                      </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            {{ $roles->links('pagination::bootstrap-4')}}
          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

