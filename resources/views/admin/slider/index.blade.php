
@extends('layouts.admin')

@section('title', 'Slider')


@section('css')
<link rel="stylesheet" href="{{asset('css/admin/indexSlider.css')}}">
@endsection

@section('content')
<!-- Content Wrapper -->
  <div class="content-wrapper">

    <!-- Content Header ) -->
    @include('admin.partials.content-header',['name'=>'Slider','key'=>'Danh sách'])
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12 d-flex justify-content-end" >
            {{-- @can('add_menu') --}}
            <a href="{{route('sliders.create')}}" class="btn btn-success m-2"><i class="fa-solid fa-plus"></i></a>
            {{-- @endcan --}}
          </div>
         
              <div class="col-md-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên slider</th>
                        <th scope="col">Miêu tả</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($sliders as $slider)
                        
                      <tr>
                        <th scope="row">{{$slider->id}}</th>
                        <td>{{$slider->name}}</td>
                        <td>{{$slider->description}}</td>
                        <td>
                            <img src=" {{$slider->image_path}}" alt="image-slider" class="image_slider"/>
                           </td>
                        <td>
                          <a href="{{route('sliders.edit',['id'=>$slider->id])}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                         
                          {{-- @can('delete_menu') --}}
                          <a href="" data-url="{{route('sliders.delete',['id'=>$slider->id])}}" class="btn btn-danger action-delete "><i class="fa-solid fa-trash"></i></a>
                          {{-- @endcan --}}
                        
                        </td>
                      </tr>

                      @endforeach
                    </tbody> 

              
                  </table>
              </div>

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                {{-- Phan trang --}}
                {{ $sliders->links() }}
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
