@extends('layouts.admin')

@section('title','Edit Product')

@section('content')

@section('css')
  <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Product', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <form action="{{ route('admin.product.update', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                  @csrf
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                        @error('name')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập giá sản phẩm" value="{{ $product->price }}">
                        @error('price')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn ảnh đại diện cho sản phẩm</label>
                        <input type="file" class="form-control-file" name="feature_image_path">
                        <div class="col-md-12 wrap-product-image">
                          <div class="row">
                            <div class="col-md-3">
                              <img class="product-image" src="{{ $product->feature_image_path }}" alt="product image" />
                            </div>        
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Chọn ảnh chi tiết cho sản phẩm</label>
                        <input multiple type="file" class="form-control-file" name="image_path[]">
                        <div class="col-md-12 wrap-detail-product-image">
                          <div class="row">
                            @foreach ( $product->images as $detailProductImage) 
                              <div class="col-md-3 content-detail-product-image">
                                <img class="detail-product-image" src="{{$detailProductImage->image_path}}" alt="detail-product-image" />      
                              </div>
                            @endforeach
                            </p>
                          </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Chọn danh mục cha</label>
                        <select class="form-control select2-init @error('category_id') is-invalid @enderror" name="category_id">
                        {!! $htmlOption !!}
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chọn tags cho sản phẩm</label>
                        <select name="tags[]" class="form-control tags-select-choose" multiple="multiple">
                            @foreach ($product->tags as $tagItem)
                              <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label>Nội dung</label>
                      <textarea class="form-control tinymce_edit_init @error('content') is-invalid @enderror" rows="16" name="content" >{{ $product->content }}</textarea>
                      @error('content')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
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
