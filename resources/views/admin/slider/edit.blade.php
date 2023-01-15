
@extends('layouts.admin')

@section('title', 'Cập nhật slide')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin/editSlider.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Slider','key'=>'Cập nhật'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('sliders.update',['id'=>$slider->id])}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="form-group col-md-12">
                                <label >Tên slider</label>
                                <input type="text" class="form-control"
                                name="name"  placeholder="Nhập tên sản phẩm" value="{{$slider->name}}">
                            </div>
                            @error('name')
                            <div class="alert alert-danger message-alert">{{ $message }}</div>
                           @enderror

                          

                            <div class="form-group col-md-12">
                              <label >Miêu tả slider</label>
                              <textarea name="description" class="form-control " rows="6">{{$slider->description}}</textarea>

                              
                              @error('description')
                              <div class="alert alert-danger message-alert">{{ $message }}</div>
                             @enderror
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label >Ảnh slider</label>
                                <input type="file" class="form-control-file"
                                name="image_path"  placeholder="Chọn ảnh slider" >
                                
                                <div class="form-group col-md-12 main-image-product-container d-flex justify-content-center align-items-center">
                                  <div class="row">
                                    <img class="main-image-product" src="{{$slider->image_path}}"/>
                                  </div>
                                </div>

                                @error('image_path')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center m-2"> 
                            <button type="submit" class="btn btn-info ">Cập nhật slider</button> 
                        </div>
                    </div>
                  </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js')



@endsection

