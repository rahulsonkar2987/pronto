@extends('admin.layout.app')
@section('css')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('categories','show')
@section('main_category_active','active')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Create a main category</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Service Categories</li>
                              <li class="breadcrumb-item">main category</li>
                              <li class="breadcrumb-item active">Create</li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          {{-- breadcrumb end here  --}}

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card text-left">
                      <div class="card-body">
                        <h4 class="card-title pb-4">
                            <div class="row justify-content-between">
                              <div class="col-lg-1">
                                <a href="{{route('admin.main_category.index')}}" class="btn btn-success">Back</a>
                              </div>
                            </div>
                        </h4>

                        <form id='FormData' method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group col-lg-7">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" placeholder="Image"">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="main_category_name">{{ ln('main_category_name','ucwords') }}</label>
                            <input type="text" name="main_category_name"  class="form-control" placeholder="{{ ln('main_category_name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="status">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value=" ">--Select One--</option>
                                <option value="1"> Active </option>
                                <option value="0">Inactive</option>
                            </select>
                          </div>

                          <div class="col-lg-12 form-froup mt-4">
                                <button class="btn btn-success dis_btn">Save</button>
                          </div>
                        </form>

                      </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- table start here  --}}
        <div class="row justify-content-center mx-3">
          <div class="col-lg-12">
              <div class="card text-left">
                <div class="card-body">
                  
                <table class="table" id='table'>
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($res as $key=>$row)
                       <tr>
                           <td>{{$key+1}} </td>
                           <td>
                              <a href="{{ asset($row->image) }}" target="_blank" rel="noopener noreferrer">
                                  <img src="{{ asset($row->image) }}" style="height: 80px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                              </a>
                          </td>
                           <td>{{ $row->main_category_name }}</td>
                           <td>
                            @if ($row->status==1)
                              <span class="badge badge-success">Active</span>
                            @else
                              <span class="badge badge-warning">Inactive</span>                                
                            @endif
                           </td>
                          <td class="td-actions">
                              {{-- <a href="{{ route('admin.main_category.show',[$row->id]) }}"><i class="la la-eye"></i></a> --}}
                              {{-- @can('admin-edit') --}}
                              <a href="{{route('admin.main_category.edit',[$row->id])}}"><i class="la la-edit"></i></a>
                              {{-- @endcan --}}
                              {{-- @can('admin-delete') --}}
                              {{-- <form id="formData" method="GET" class="d-inline"> --}}
                              <a href="#" data-id="{{ $row->id }}"  class="delete dis_btn"><i class="la la-close"></i></a>

                              {{-- @endcan --}}
                          </td>

                      </tr>
                       @endforeach 
                    </tbody>
                </table>

              </div>
          </div>
      </div>

        
    </div>
@endsection
@section('js');
<script>
    $(document).ready(function(){

    $('#FormData').submit(function(e){
      e.preventDefault();
      $('.dis_btn').prop('disabled',true);
      var formdata = new FormData(this);
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.main_category.store',['_token'=>csrf_token()])}}",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            getError(jqXHR,get_error);
          },
          success: function(get){
            if(get.action==true){
              location.reload();
            }
          }
      });
    });


    $(document).on('click','.delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $(this).data('token');
            var tr = $(this);
            if (confirm('Do you want to delete this?')) {
                $.ajax({
                    url: "{{route('admin.main_category.destroy','')}}"+'/'+id,
                    type: "delete",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    data: {id:id},
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error:function (jqXHR,get_error) {
                        getError(jqXHR,get_error);
                    },
                    success: function(get){
                        console.log(get.data);
                        if(get.action==true){
                            $(tr).fadeOut().closest("tr").remove();
                        }else if(get.action==false){
                            location.reload();
                        }else if(get.exist==true){
                          location.reload();
                        }else{
                          console.log(get.msg);
                        }
                    }
                });
            }
        });




});

</script>
@endsection
