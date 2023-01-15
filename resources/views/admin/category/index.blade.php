
@extends('layouts.admin')

@section('title', 'Danh mục sản phẩm')

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Danh mục sản phẩm','key'=>'Danh sách'])
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 d-flex justify-content-end" >
            @can('add_category')
            <a href="{{route('categories.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
            @endcan
            
          </div>
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên danh mục sản phẩm</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($categories as $category)
                        
                      <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>

                          @can('edit_category')
                          <a href="{{route('categories.edit',['id'=>$category->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          @endcan
                        

                          {{-- <a href="{{route('categories.delete',['id'=>$category->id])}}" data-url="" class="btn btn-danger action-delete"><i class="fa-solid fa-trash"></i></a> --}}

                          @can('delete_category')
                          <a href="" data-url="{{route('categories.delete',['id'=>$category->id])}}" data-url="" class="btn btn-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                          @endcan
                        </td>
                      </tr>

                      @endforeach
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $categories->links() }}
              </div>

        </div>
     
      </div>
    </div>

  </div>
 
@endsection


@section('js')
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>


<script src="{{asset('js/admin/actionDelete.js')}}"></script>
@endsection


