
@extends('layouts.admin')

@section('title', 'Thêm mới sản phẩm')

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/admin/addProduct.css')}}">

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
    @include('admin.partials.content-header',['name'=>'Sản phẩm','key'=>'Thêm mới'])

{{--         
    <div class="col-md-12">
      @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
    @endif
  </div> --}}

    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('products.store')}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf
                    <div class="row">
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="form-group col-md-6">
                                <label >Tên sản phẩm</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name"  placeholder="Nhập tên sản phẩm" value="{{old('name')}}">

                                @error('name')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label >Giá sản phẩm</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                name="price"  placeholder="Nhập giá sản phẩm" value="{{old('price')}}">
                                   
                                @error('price')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label >Ảnh sản phẩm</label>
                                <input type="file" class="form-control-file"
                                name="feature_image_path"  placeholder="Chọn ảnh sản phẩm" onchange="readURL(this);">

                                  {{-- <img id="blah" src="#" alt="choose image" /> --}}

                                <div class="form-group col-md-12 main-image-product-container d-flex justify-content-center align-items-center">
                                  <div class="row">
                                    <img id="blah" src="#" alt="choose image" />
                                  </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label >Ảnh chi tiết</label>

                                <input id="files" type="file" accept="image/*" multiple class="form-control-file"
                                name="image_path[]"  placeholder="Chọn ảnh sản phẩm" >
                              
                                {{-- <div id="preview"></div> --}}
  
                                <div class="form-group col-md-12 d-flex justify-content-center align-items-center sub-image-product-container">
                                      <div class="row ">
                                            <div id="preview"></div>
                                      </div>
                                </div>
                          </div>

                           
        
                            <div class="form-group col-md-6">
                                <label for="">Chọn danh mục sản phẩm</label>
                                <select name="category_id" class="form-control select2_init @error('category_id') is-invalid @enderror">
                                <option value="">Chọn danh mục sản phẩm</option>
                                {{-- dau !!!! la goi bien co chua chuoi --}}
                               {!! $htmlOption !!}
                                </select>
                                   
                                @error('category_id')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Nhập tags</label>
                                 <select name="tags[]" class="form-control tags-select-choose" multiple="multiple">
                                 </select>
                            </div>
                            

                            <div class="form-group col-md-12">
                                <label >Miêu tả sản phẩm</label>
                                <textarea name="content" id="tinymce5-editor-init" class="form-control tinymce5-editor-init @error('content') is-invalid @enderror" rows="6">
                                 {{old('content')}}</textarea>

                                @error('content')
                                <div class="alert alert-danger message-alert">{{ $message }}</div>
                               @enderror
                              </div>
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center m-2"> 
                            <button type="submit" class="btn btn-success ">Tạo sản phẩm</button> 
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
<script type="text/javascript" src="{{asset('js/admin/addProduct.js') }}"></script>


<script src="https://cdn.tiny.cloud/1/xrlr14bgpo57f7bjdvuo228v0aliwgqk40mzbzwo11q8w26d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script src="{{asset('js/admin/showImageUpload.js')}}"></script>
<script src="{{asset('js/admin/showMuiltiImageUpload.js')}}"></script>


{{-- <script
class="jsbin"
src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
></script> --}}

{{-- <script
class="jsbin"
src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"
></script> --}}

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
@endsection

