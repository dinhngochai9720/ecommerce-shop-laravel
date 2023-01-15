
@extends('layouts.admin')

@section('title', 'Menu')

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Menu','key'=>'Danh sách'])
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 d-flex justify-content-end" >
            @can('add_menu')
            <a href="{{route('menus.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
            @endcan
          </div>
         
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên menu</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($menus as $menu)
                        
                      <tr>
                        <th scope="row">{{$menu->id}}</th>
                        <td>{{$menu->name}}</td>
                        <td>
                          @can('edit_menu')
                          <a href="{{route('menus.edit',['id'=>$menu->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          @endcan
                         
                          @can('delete_menu')
                          <a href="" data-url="{{route('menus.delete',['id'=>$menu->id])}}" class="btn btn-danger action-delete "><i class="fa-solid fa-trash"></i></a>
                          @endcan
                        
                        </td>
                      </tr>

                      @endforeach
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $menus->links() }}
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
