@extends('layouts.admin')

@section('title','Slider')

@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('admins/slider/list/list.css') }}" />
@endsection

@section('js')
  <script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
  <script src="{{ asset('admins/main.js')}}"></script>
@endsection
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Slider', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('admin.slider.create') }}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Slider</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach($sliders as $slider)
                      <tr>
                        <td>{{ $slider->id }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->description }}</td>
                        <td>
                          <img class="image_slider" src="{{$slider->image_path}}" alt="slider"/>
                        </td>
                        <td>
                          <a href="{{ route('admin.slider.edit', ['id' => $slider->id ]) }}" class="btn btn-default">Edit</a>
                          <a href="" data-url="{{ route('admin.slider.delete', ['id' => $slider->id]) }}" class="btn btn-danger active_delete">Delete</a>
                        </td>
                      </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
            {{ $sliders->links('pagination::bootstrap-4')}}
          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

