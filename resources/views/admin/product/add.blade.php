@extends('layouts.admin')

@section('title','Add Product')

@section('content')

@section('css')
  <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Product', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <form action="{{ route('admin.product.store')}}" method="post" enctype="multipart/form-data">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  @csrf
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input value="{{ old('price') }}"  type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập giá sản phẩm">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn ảnh đại diện cho sản phẩm</label>
                        <input type="file" class="form-control-file" name="feature_image_path">
                    </div>
                    <div class="form-group">
                        <label>Chọn ảnh chi tiết cho sản phẩm</label>
                        <input multiple type="file" class="form-control-file" name="image_path[]">
                    </div>
                    <div class="form-group">
                        <label>Chọn danh mục cha</label>
                        <select class="@error('category_id') is-invalid @enderror form-control select2-init" name="category_id">
                        <option value=""></option>
                        {!! $htmlOption !!}
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn tags cho sản phẩm</label>
                        <select name="tags[]" class="form-control tags-select-choose" multiple="multiple">
                          
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Nội dung</label>
                      <textarea class="form-control tinymce_edit_init @error('content') is-invalid @enderror" rows="16" name="content">
                        {{ old('content') }}
                      </textarea>
                      @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
            <!-- /.content -->
      </div>
    </form>
  <!-- /.content-wrapper -->

@endsection

@section('js')
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('admins/product/add/add.js')}}"></script>
@endsection
