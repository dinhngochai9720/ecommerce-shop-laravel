
@extends('layouts.admin')

@section('title', 'Thêm mới user')

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/admin/addUser.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Tài khoản','key'=>'Thêm mới'])


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('users.store')}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row d-flex flex-column align-items-center justify-content-center">
                        <div class="col-md-6 d-flex flex-column ">
                            <div class="form-group col-md-12">
                                <label >Tên</label>
                                <input type="text" class="form-control"
                                name="name"  placeholder="Nhập tên " value="{{old('name')}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label >Email</label>
                                <input type="text" class="form-control"
                                name="email"  placeholder="Nhập email" value="{{old('email')}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label >Password</label>
                                <input type="password" class="form-control"
                                name="password"  placeholder="Nhập password" >
                            </div>

                            <div class="form-group col-md-12">
                                <label >Chọn vai trò</label>
                                <select name="role_id[]" class="form-control roles-select-choose" multiple='multiple'>
                                            <option value=""></option>
                                            @foreach ($roles as $role )
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                </select>
                            </div>

                        </div>
                        
                    
                        <div class="col-md-6 d-flex justify-content-center align-items-center m-2"> 
                            <button type="submit" class="btn btn-success ">Tạo tài khoản</button> 
                        </div>
                    </div>
                  </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js')
{{-- select 2 library--}}
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>

<script src="https://cdn.tiny.cloud/1/xrlr14bgpo57f7bjdvuo228v0aliwgqk40mzbzwo11q8w26d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript" src="{{asset('js/admin/addUser.js') }}"></script>


@endsection

