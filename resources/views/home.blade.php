@extends('layouts.admin')

@section('title','Trang chủ')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('partials.content-header', [ 'name' => 'Home', 'key' => 'Home'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          Trang chủ
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

