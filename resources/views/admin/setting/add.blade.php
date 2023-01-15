
@extends('layouts.admin')

@section('title', 'Thêm mới setting')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Setting','key'=>'Thêm mới'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="" method="POST">
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="form-group col-md-6">
                                <label >Tên setting</label>
                                <input type="text" class="form-control"
                                name="config_key"  placeholder="Nhập tên setting">
                            </div>

                            <div class="form-group col-md-6">
                              <label >Giá trị</label>
                              <input type="text" class="form-control"
                              name="config_value"  placeholder="Nhập giá trị">
                          </div>
        
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center"> 
                            <button type="submit" class="btn btn-success ">Tạo setting</button> 
                        </div>
                    </div>
                  </form>
        </div>
      </div>
    </div>
  </div>
@endsection

