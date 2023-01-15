
@extends('layouts.admin')

@section('title', 'Thêm mới slider')



@section('css')

<link rel="stylesheet" href="{{asset('css/admin/addSlider.css')}}">

<link
class="jsbin"
href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css"
rel="stylesheet"
type="text/css"
/>

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Slider','key'=>'Thêm mới'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="form-group col-md-12">
                                <label >Tên slider</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name"  placeholder="Nhập tên slider" value="{{old('name')}}">

                                @error('name')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>


                            <div class="form-group col-md-12">
                                <label >Miêu tả sản slider</label>
                                <textarea name="description"  class="form-control  @error('description') is-invalid @enderror" rows="6">
                                 {{old('description')}}</textarea>

                                @error('description')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                              </div>


                            <div class="form-group col-md-6">
                               <label >Hình ảnh</label>
                                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror"
                                name="image_path"  placeholder="Chọn slider" onchange="readURL(this);">

                                <div class="form-group col-md-12 main-image-product-container d-flex justify-content-center align-items-center">
                                  <div class="row">
                                    <img id="blah" src="#" alt="choose image" />
                                  </div>
                                </div>

                                @error('image_path')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>
        
                          
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center"> 
                            <button type="submit" class="btn btn-success ">Tạo slider</button> 
                        </div>
                    </div>
                     
                    
                  </form>
          
        </div>
      
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{asset('js/admin/showImageUpload.js')}}"></script>


@endsection