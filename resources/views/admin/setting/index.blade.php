
@extends('layouts.admin')

@section('title', 'Setting')

@section('css')

@endsection

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Setting','key'=>'Danh sách'])

   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
      
          <div class="col-md-12 d-flex justify-content-end" >
            <a href="{{route('settings.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
          </div>

              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên setting</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      {{-- @foreach ($data_products as $data_product) --}}
                        
                      <tr>
                        <th scope="row">1</th>
                        <td>config key</td>
                        <td>config value</td>
                        <td>
                          <a href="" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          <a href="" data-url="" class="btn btn-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr> 

                      {{-- @endforeach --}}
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{-- {{ $data_products->links() }} --}}
              </div>

        </div>
     
      </div>
    </div>

  </div>
 
@endsection

@section('js')
{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>
<script src="{{asset('js/admin/deleteProduct.js')}}"></script>
@endsection



