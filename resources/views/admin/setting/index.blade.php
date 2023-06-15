@extends('layouts.admin')

@section('title','Setting')

@section('content')


@section('js')
  <script src="{{ asset('vendors/sweetalert2/sweetalert2@11.js') }}"></script>
  <script src="{{ asset('admins/main.js')}}"></script>
@endsection

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Setting', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="btn-group float-right mb-1 mr-5">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Add
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('admin.setting.create') . '?type=text'}}">Text</a>
              <a class="dropdown-item" href="{{ route('admin.setting.create') . '?type=textarea'}}">Textarea</a>
            </div>
          </div>
          </div>
          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Config Key</th>
                  <th scope="col">Config Value</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($settings as $setting)
                    <tr>
                      <td>{{ $setting->id }}</td>
                      <td>{{ $setting->config_key }}</td>
                      <td>{{ $setting->config_value }}</td>
                      <td>
                        <a href="{{ route('admin.setting.edit', ['id' => $setting->id ])}}" class="btn btn-default">Edit</a>
                        <a href="" data-url="{{ route('admin.setting.delete', [ 'id' => $setting->id ]) }}" class="btn btn-danger active_delete">Delete</a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-12">
          </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

