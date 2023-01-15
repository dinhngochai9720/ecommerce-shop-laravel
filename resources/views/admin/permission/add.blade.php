
@extends('layouts.admin')

@section('title', 'Thêm mới phân quyền chức năng')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Phân quyền chức năng','key'=>'Thêm mới'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('permissions.store')}}" method="POST">
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex">
                           
                            <div class="form-group col-md-6">
                                <label for="">Chọn phân quyền</label>
                                <select name="module_parent" class="form-control">
                                    <option value="">Chọn phân quyền</option>
                                      @foreach (config('permissions.table_module') as $table_module_item )
                                             <option value="{{$table_module_item}}">{{$table_module_item}}</option>
                                      @endforeach
                              
                                </select>
                            </div>

                            <div class="form-group col-md-6 ">
                                <div class="row">
                                    <label class="col-md-12">Chọn chức năng</label>

                                     <div class="col-md-12 d-flex">
                                        @foreach (config('permissions.table_module_function') as $table_module_function_item )
                                        <div class="col-md-3 ">
                                            <label>
                                                <input type="checkbox"  name="module_childrent[]" value="{{$table_module_function_item}}">
                                                {{$table_module_function_item}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                 </div>
                             </div>
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center"> 
                            <button type="submit" class="btn btn-success ">Tạo phân quyền chức năng</button> 
                        </div>
                    </div>
                     
                    
                  </form>
          
        </div>
      
      </div>
    </div>
  </div>
@endsection

