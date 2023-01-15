
@extends('layouts.admin')

@section('title', 'Thêm mới vai trò tài khoản')

@section('css')

<link rel="stylesheet" href="{{asset('css/admin/addRole.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Vai trò tài khoản','key'=>'Thêm mới'])


    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('roles.store')}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="form-group col-md-12">
                                <label >Tên vai trò</label>
                                <input type="text" class="form-control "
                                name="name"  placeholder="Nhập tên vai trò" value="{{old('name')}}">

                            </div>

                            <div class="form-group col-md-12">
                                <label >Miêu tả vai trò</label>
                                <textarea name="display_name" id="tinymce5-editor-init" class="form-control tinymce5-editor-init " rows="12">
                                 {{old('display_name')}}</textarea>

                            </div>
                        </div>
                    

                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-12">
                                        <lable >
                                            <input type="checkbox" value="" class="checkbox_all">
                                        </lable>
                                     Chọn tất cả
                                    </div>


                                    @foreach ( $permissionParents as $permissionParentItem )
                                            <div class="card border-primary mb-3 col-md-12 p-0 " >
                                                        <div class="card-header bg-card-header">
                                                            <lable >
                                                                <input type="checkbox" value="" class="checkbox_all_one">
                                                            </lable>
                                                            Module {{$permissionParentItem->name}}
                                                        </div>
                                                        
                                                        <div class="row">
                                                           @foreach ($permissionParentItem->permissionChildrents as  $permissionChildrentItem)
                                                            <div class="card-body text-primary col-md-3">
                                                                <h5 class="card-title">
                                                                    <lable >
                                                                        <input type="checkbox" name="permission_id[]" value="{{$permissionChildrentItem->id}}"
                                                                        class="checkbox_one">
                                                                    </lable>
                                                                    {{$permissionChildrentItem->name}}
                                                                </h5>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        
                                                </div>

                                         @endforeach
                                    </div>
                                </div>
                                    
                            </div>
                            
                        </div>

                    
                      
                            <div class="row d-flex justify-content-center align-items-center mt-2 ">
                                <div class="col-md-10 d-flex justify-content-end align-items-center">
                                      <button type="submit" class="btn btn-success ">Tạo vai trò tài khoản</button> 
                                </div>
                            </div>
                  </form>
            </div>

        </div>
    </div>
</div>
@endsection


@section('js')

<script type="text/javascript" src="{{asset('js/admin/addRole.js') }}"></script>

@endsection

