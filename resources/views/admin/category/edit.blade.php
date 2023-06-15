@extends('layouts.admin')

@section('title','Edit category')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Category', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <form action="{{ route('admin.categories.update', ['id' => $category->id])}}" method="post">
              @csrf
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên danh mục" value="{{ $category->name }}">
                    @error('name')
                          <div class="alert alert-danger  pt-1 pb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Chọn danh mục cha</label>
                    <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                    <option value="0">Chọn danh mục cha</option>
                    {!! $htmlOption !!}
                    </select>
                    @error('parent_id')
                          <div class="alert alert-danger  pt-1 pb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

