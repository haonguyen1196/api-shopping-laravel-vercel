@extends('layouts.admin')

@section('title','Edit Role')

@section('css')
  <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}" />
@endsection

@section('js')
  <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Role', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.role.update', [ 'id' => $role->id ]) }}" method="post">
                  @csrf
                    <div class="form-group">
                        <label>Tên vai trò</label>
                        <input value="{{ $role->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên vai trò">
                        @error('name')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mô tả vai trò</label>
                        <textarea class="form-control @error('display_name') is-invalid @enderror" rows="4" name="display_name">{{ $role->display_name }}</textarea>
                        @error('display_name')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                      <label>
                        <input type="checkbox" class="checked_all"/>
                        Chọn tất cả
                      </label>
                    </div>
                    @foreach($permissionParents as $permissionParentItem)
                      <div class="card border-primary mb-3" style="max-width: 100%">
                        <div class="card-header card_header_title">
                          <label class="label-header">
                            <input type="checkbox" value="" class="checkbox_parent"/>
                          </label>
                          Module {{ $permissionParentItem->name }}
                        </div>
                        <div class="row">
                          @foreach($permissionParentItem->permissionChildren as $permissionChildrenItem) 
                            <div class="card-body text-primary col-md-3">
                              <h5 class="card-title">
                                <input 
                                  {{ $permissionChecked->contains('id' , $permissionChildrenItem->id) ? 'checked' : '' }}
                                  class="checkbox_children" 
                                  type="checkbox" 
                                  name="permission_id[]" 
                                  value="{{ $permissionChildrenItem->id }}"/>
                                {{ $permissionChildrenItem->name }}
                              </h5>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
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

