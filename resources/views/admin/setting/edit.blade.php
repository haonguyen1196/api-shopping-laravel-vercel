@extends('layouts.admin')

@section('title','Edit Setting')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Setting', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
           <div class="col-md-6">
              <form action="{{ route('admin.setting.update', [ 'id' => $setting->id ]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Config Key</label>
                    <input value="{{ $setting->config_key }}" type="text" class="form-control @error('config_key') is-invalid @enderror" name="config_key" placeholder="Nhập config key">
                    @error('config_key')
                        <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                    @enderror
                </div>
                @if($setting->type === 'text')
                  <div class="form-group">
                      <label>Config value</label>
                      <input value="{{ $setting->config_value }}" type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Nhập config value">
                        @error('config_value')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                  </div>
                  @elseif ($setting->type === 'textarea')
                    <div class="form-group">
                        <label>Config value</label>
                        <textarea class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Nhập config value" rows="4">{{ $setting->config_value }}</textarea>
                        @error('config_value')
                            <div class="alert alert-danger pt-1 pb-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
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

