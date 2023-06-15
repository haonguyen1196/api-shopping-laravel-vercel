@extends('layouts.admin')

@section('title','Add Menu')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Menus', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
              <form action="{{ route('admin.menus.store')}}" method="post">
                @csrf
                  <div class="form-group">
                      <label>Tên Menu</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" placeholder="Nhập tên menu">
                      @error('name')
                          <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label>Chọn menu cha</label>
                      <select class="form-control" name="parent_id">
                      <option value="0">Menu cha</option>
                      {!! $optionSelect !!}
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

