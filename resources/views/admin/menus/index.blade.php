@extends('layouts.admin')

@section('title','Menu')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Menus', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('admin.menus.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên Menu</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $menus as $menuItem )
                    <tr>
                      <td>{{ $menuItem->id }}</td>
                      <td>{{ $menuItem->name }}</td>
                      <td>
                        <a href="{{ route('admin.menus.edit', ['id' => $menuItem->id ])}}" class="btn btn-default">Edit</a>
                        <a href="{{ route('admin.menus.delete', ['id' => $menuItem->id]) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            {{ $menus->links('pagination::bootstrap-4')}}
          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

