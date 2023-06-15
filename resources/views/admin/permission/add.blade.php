@extends('layouts.admin')

@section('title','Add Permission')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Permission', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <form action="{{ route('admin.permission.store')}}" method="post">
                @csrf
                  <div class="form-group">
                      <label>Chọn tên module</label>
                      <select class="form-control @error('module_parent') is-invalid @enderror" name="module_parent">
                      <option value="">Chọn tên module</option>
                      @foreach(config('permissions.table_module') as $moduleItem)
                        <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                      @endforeach
                      </select>
                      @error('module_parent')
                          <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <div class="row">
                      @foreach(config('permissions.module_children') as $moduleChildrenItem)
                          <div class="col-md-3">
                              <label>
                                  <input type="checkbox" value="{{ $moduleChildrenItem }}" name="module_children[]"/>
                                  {{ $moduleChildrenItem }}
                              </label>
                          </div>
                      @endforeach
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

