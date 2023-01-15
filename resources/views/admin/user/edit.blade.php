
@extends('layouts.admin')

@section('title', 'Cập nhật tài khoản')

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/admin/editUser.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Tài khoản','key'=>'Cập nhật'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('users.update',['id'=>$user->id])}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row d-flex flex-column align-items-center justify-content-center">
                        <div class="col-md-6 d-flex flex-column ">
                            <div class="form-group col-md-12">
                                <label >Tên</label>
                                <input type="text" class="form-control"
                                name="name"  placeholder="Nhập tên " value="{{$user->name}}">
                            </div>

                            <div class="form-group col-md-12">
                                <label >Email</label>
                                <input type="text" class="form-control"
                                name="email"  placeholder="Nhập email" value="{{$user->email}}">
                            </div>

                            {{-- <div class="form-group col-md-12">
                                <label >Password</label>
                                <input type="password" class="form-control"
                                name="password"  placeholder="Nhập password" value="{{$user->password}}"  maxlength="10" >
                            </div> --}}

                            <div class="form-group col-md-12">
                                <label for="">Chọn vai trò</label>
                                 <select name="role_id[]" class="form-control roles-select-choose" multiple="multiple">
                                      @foreach ($roles as $role)
                                      {{--$rolesOfUser->contains('id',$role->id) ? 'selected' : ''  :if user have role -> show role else do not show --}}
                                          <option {{$rolesOfUser->contains('id',$role->id) ? 'selected' : ''}} value="{{$role->id}}" >
                                          {{$role->name}}</option>
                                      @endforeach
                                 </select>
                            </div>

                        </div>
                        
                    
                        <div class="col-md-6 d-flex justify-content-center align-items-center m-2"> 
                            <button type="submit" class="btn btn-info ">Cập nhật tài khoản</button> 
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

