@extends('admin.layout.app')
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
                                <a href="{{route('admin.main_category.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        <div class="row my-5">

                          <div class="form-group col-lg-7">
                            <label for="Main Category name">Main Category name</label>
                            <select name="main_category_id" id="" class="form-control">
                                <option value=" ">--Select One--</option>
                                @foreach ($res_mc as $row_mc)
                                  <option value="{{ $row_mc->id }}" {{ $row_mc->id==$row->main_category_id ? 'selected' : '' }}>{{ $row_mc->main_category_name }}</option>                                    
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="sub_category_name"><strong>{{ ln('sub_category_name','ucwords') }}</strong></label>
                            <input type="text" name="sub_category_name" value="{{ $row->sub_category_name }}"  class="form-control" placeholder="{{ ln('sub_category_name','ucwords') }}"  >
                          </div>

                          <style>
                            input[type="checkbox"] {
                                accent-color: #c9302c;
                              }
                          </style>
                          <div class="form-group col-lg-7">
                            <label for="sub_category_name">{{ ln('Premium ','ucwords') }}</label>
                            <input type="checkbox"  class="ml-3 text-danger" name="premium" id="" value="1" {{ $row->premium==1 ? 'checked' : '' }} >
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
                          {!! Form::close() !!}
                                    
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
          url: "{{route('admin.sub_category.update',[$row->id])}}",
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
              window.location.href="{{ route('admin.main_category.index') }}";
            }else if(get.action==false){
              location.reload();
            }
          }
      });
    });



});

</script>
@endsection
