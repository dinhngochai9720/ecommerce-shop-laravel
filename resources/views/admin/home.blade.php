
@extends('layouts.admin')

@section('title', 'Trang chủ')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     @include('admin.partials.content-header',['name'=>'Trang chủ','key'=>'Thống kê'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
              Trang home hiển thị thống kê
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

