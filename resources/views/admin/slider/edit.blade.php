@extends('layouts.admin')

@section('title','Edit Slider')

@section('css')
  <link rel="stylesheet" href="{{ asset('admins/slider/edit/edit.css') }}" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Slider', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.slider.update', [ 'id' => $slider->id ]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                        <label>Tên Slider</label>
                        <input value="{{ $slider->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên slider">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description">{{ $slider->description }}</textarea>
                        @error('description')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label>Chọn ảnh</label>
                      <input multiple type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path">
                      @error('image_path')
                          <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                      @enderror
                      <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4">
                              <img class="image_slider pt-1 pb-1" src="{{ $slider->image_path }}" alt="slider" />
                            </div>        
                          </div>
                        </div>
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

