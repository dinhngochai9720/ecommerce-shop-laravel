
@extends('layouts.admin')

@section('title', 'Sản phẩm')

@section('css')
<link rel="stylesheet" href="{{asset('css/admin/indexProduct.css')}}">
@endsection

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Sản phẩm','key'=>'Danh sách'])

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
      
          <div class="col-md-12 d-flex justify-content-end" >
              
            @can('add_product')
            <a href="{{route('products.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
            @endcan

          </div>
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Danh mục sản phẩm</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($data_products as $data_product)
                        
                      <tr>
                        <th scope="row">{{$data_product->id}}</th>
                        <td>{{$data_product->name}}</td>
                        <td>{{number_format($data_product->price)}}</td>
                        <td>
                            <img src="{{$data_product->feature_image_path}}" alt="image-product" class="image_product"/>
                        </td>
                        <td>{{optional($data_product->category)->name}}</td>
                        <td>
                       
                       
                          @can('edit_product', $data_product->id)
                               <a href="{{route('products.edit',['id'=>$data_product->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          @endcan


                          @can('delete_product')
                          <a href="" data-url="{{route('products.delete',['id'=>$data_product->id])}}" class="btn btn-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                          @endcan
                        </td>
                      </tr>

                      @endforeach
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $data_products->links() }}
              </div>

        </div>
     
      </div>
    </div>

  </div>
 
@endsection

@section('js')
{{-- use link cnd --}}
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- use in project after download --}}
<script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>

<script src="{{asset('js/admin/actionDelete.js')}}"></script>
@endsection



