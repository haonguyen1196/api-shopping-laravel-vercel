@extends('layouts.admin')

@section('title','Add Slider')

@section('css')
  <link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Slider', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label>Tên Slider</label>
                        <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên slider">
                        @error('name')
                            <div class="alert alert-danger  pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger  pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label>Chọn ảnh</label>
                      <input multiple type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path">
                      @error('image_path')
                          <div class="alert alert-danger  pt-1 pb-1">{{ $message }}</div>
                      @enderror
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

