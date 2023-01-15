
@extends('layouts.admin')

@section('title', 'Sửa menu')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Menu','key'=>'Sửa'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">


                <form class="col-md-10 " action="{{route('menus.update',['id' => $menu->id] )}}" method="POST">
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="form-group col-md-6">
                                <label >Tên menu</label>
                                <input type="text" class="form-control"
                                name="name" value="{{$menu->name}}"  placeholder="Nhập tên danh mục">
                            </div>
        
                            <div class="form-group col-md-6">
                                <label for="">Chọn menu</label>
                                <select name="parent_id" class="form-control">
                                <option value="0">Chọn menu</option>
                                {{-- dau !!!! la goi bien co chua chuoi --}}
                               {!! $htmlOption !!}
                                </select>
                            </div>
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center"> 
                            <button type="submit" class="btn btn-primary ">Cập nhật</button> 
                        </div>
                    </div>
                     
                    
                  </form>
          
        </div>
      
      </div>
    </div>
  </div>
@endsection

