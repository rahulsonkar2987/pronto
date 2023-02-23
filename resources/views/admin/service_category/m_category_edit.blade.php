@extends('admin.layout.app')
@section('pets','show')
@section('categories','show')
@section('main_category_active','active')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a main category name</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Service Categories</li>
                              <li class="breadcrumb-item">Main category</li>
                              <li class="breadcrumb-item active">Edit</li>
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
                        <h4 class="card-title">
                            <div class="row justify-content-between">
                              <div class="col-lg-1">
                                <a href="{{route('admin.main_category.create')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        <form id='FormData' method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{ route('admin.main_category.update',[$row->id]) }}" method="POST" enctype="multipart/form-data"> --}}
                          @csrf 
                          {{-- @method('patch') --}}
                        <div class="row my-5">

                          <div class="form-group col-lg-7">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" placeholder="Image"">
                            <img src="{{ asset($row->image) }}" style="width: 60px" class="mt-2 ml-1 img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                          </div>

                            <div class="form-group col-lg-7">
                              <label for="main_category_name"><strong>{{ ln('main_category_name','ucwords') }}</strong></label>
                              <input type="text" name="main_category_name" value="{{ $row->main_category_name }}"  class="form-control" placeholder="{{ ln('main_category_name','ucwords') }}"  >
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="status">Status</label>
                              <select name="status" id="" class="form-control">
                                  <option value=" ">--Select One--</option>
                                  <option value="1" {{ $row->status=='1' ? 'selected' : '' }}> Active </option>
                                  <option value="0" {{ $row->status=='0' ? 'selected' : '' }}>Inactive</option>
                              </select>
                            </div>

                            <div class="col-lg-12 form-froup mt-4">
                                  <button class="btn btn-danger dis_btn">Save</button>
                            </div>
                          </div>
                        </form>
                                    
                      </div>
                    </div>
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
      formdata.append('_method', 'patch');
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.main_category.update',[$row->id])}}",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            getError(jqXHR,get_error);
          },
          success: function(get){
            $('.dis_btn').prop('disabled',false);
            console.log(get.data);
            if(get.action==true){
              window.location.href="{{ route('admin.main_category.create') }}";
            }else if(get.action==false){
              location.reload();
            }
          }
      });
    });



});

</script>
@endsection
