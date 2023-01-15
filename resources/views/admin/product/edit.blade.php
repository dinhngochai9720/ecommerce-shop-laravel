
@extends('layouts.admin')

@section('title', 'Cập nhật sản phẩm')

@section('css')
<link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/admin/editProduct.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Content Header -->
    @include('admin.partials.content-header',['name'=>'Sản phẩm','key'=>'Cập nhật'])
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center ">

                <form class="col-md-10 " action="{{route('products.update',['id'=>$product->id])}}" method="POST" enctype='multipart/form-data'>
                  {{-- Bao mat --}}
                  @csrf 
                    <div class="row">
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="form-group col-md-6">
                                <label >Tên sản phẩm</label>
                                <input type="text" class="form-control"
                                name="name"  placeholder="Nhập tên sản phẩm" value="{{$product->name}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label >Giá sản phẩm</label>
                                <input type="number" class="form-control"
                                name="price"  placeholder="Nhập giá sản phẩm" value="{{$product->price}}">
                            </div>

                            
                            <div class="form-group col-md-6">
                                <label >Ảnh sản phẩm</label>
                                <input type="file" class="form-control-file"
                                name="feature_image_path"  placeholder="Chọn ảnh sản phẩm" >
                                
                                <div class="form-group col-md-12 main-image-product-container d-flex justify-content-center align-items-center">
                                  <div class="row">
                                    <img class="main-image-product" src="{{$product->feature_image_path}}"/>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label >Ảnh chi tiết</label>
                                <input type="file" multiple="multiple" class="form-control-file"
                                name="image_path[]"  placeholder="Chọn ảnh sản phẩm">

                                <div class="form-group col-md-12 d-flex justify-content-center align-items-center sub-image-product-container">
                                  <div class="row ">
                                    {{-- $product->images :get all data from product_images table --}}
                                    @foreach ( $product->images as $productImageItem )
                                    <div class="form-group col-md-4"> <img class="sub-image-product" src="{{$productImageItem->image_path}}"/></div>
                                    @endforeach
                                    
                                  </div>
                                </div>
                            </div>

                           
        
                            <div class="form-group col-md-6">
                                <label for="">Chọn danh mục sản phẩm</label>
                                <select name="category_id" class="form-control select2_init">
                                <option value="">Chọn danh mục sản phẩm</option>
                                {{-- dau !!!! la goi bien co chua chuoi --}}
                               {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Nhập tags</label>
                                 <select name="tags[]" class="form-control tags-select-choose" multiple="multiple">
                                   {{-- $product->tags :get all data from tags table --}}
                                  @foreach ($product->tags as $tagItem)
                                  <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                  @endforeach
                                  
                                 </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label >Miêu tả sản phẩm</label>
                                <textarea name="content" id="tinymce5-editor-init" class="form-control tinymce5-editor-init" rows="6">{{$product->content}}</textarea>
                              </div>
                        </div>
                        
                    
                        <div class="col-md-12 d-flex justify-content-end align-items-center m-2"> 
                            <button type="submit" class="btn btn-info ">Cập nhật sản phẩm</button> 
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

<script type="text/javascript" src="{{asset('js/admin/addProduct.js') }}"></script>


@endsection

