
@extends('layouts.admin')

@section('title', 'Vai trò tài khoản')

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Vai trò tài khoản','key'=>'Danh sách'])
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 d-flex justify-content-end" >
            <a href="{{route('roles.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
          </div>
         
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên vai trò</th>
                        <th scope="col">Mô tả vai trò</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($roles as $role)
                        
                      <tr>
                        <th scope="row">{{$role->id}}</th>
                        <td>{{$role->name}}</td>
                        <td>{{$role->display_name}}</td>
                        <td>
                            {{-- {{route('roles.delete',['id'=>$menu->id])}} --}}
                          <a href="{{route('roles.edit',['id'=>$role->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          <a href="" data-url="{{route('roles.delete',['id'=>$role->id])}}" class="btn btn-danger action-delete "><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>

                      @endforeach
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $roles->links() }}
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
