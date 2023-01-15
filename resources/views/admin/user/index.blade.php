
@extends('layouts.admin')

@section('title', 'Tài khoản')

@section('css')
@endsection

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Tài khoản','key'=>'Danh sách'])

   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
      
          <div class="col-md-12 d-flex justify-content-end" >
            @can('add_user')
                   <a href="{{route('users.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
            @endcan
          </div>
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($users as $user)
                        
                      <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                      
                        <td>
                          {{-- edit button --}}
                          @can('edit_user')
                          <a href="{{route('users.edit',['id'=>$user->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                          @endcan
                         
                          {{-- delete button --}}
                          @can('delete_user')
                                <a href="" data-url="{{route('users.delete',['id'=>$user->id])}}" class="btn btn-danger action-delete"><i class="fa-solid fa-trash"></i></a>
                          @endcan
                        
                        </td>
                      </tr>

                      @endforeach
                    </tbody>

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $users->links() }}
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



