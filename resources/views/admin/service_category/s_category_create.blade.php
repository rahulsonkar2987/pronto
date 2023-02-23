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
                      <h2 class="page-header-title">Create a Sub category</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Service Categories</li>
                              <li class="breadcrumb-item">Sub category</li>
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
                            <label for="status">{{ ln('main_category_name','ucwords') }}</label>
                            <select name="main_category_id"  class="form-control">
                                <option value=" ">--Select One--</option>
                                @foreach ($res as $row)
                                    <option value="{{ $row->id }}">{{ $row->main_category_name }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="sub_category_name">{{ ln('sub_category_name','ucwords') }}</label>
                            <input type="text" name="sub_category_name"  class="form-control" placeholder="{{ ln('sub_category_name','ucwords') }}">
                          </div>

                          <style>
                            input[type="checkbox"] {
                                accent-color: #c9302c;
                              }
                          </style>
                          <div class="form-group col-lg-7">
                            <label for="sub_category_name">{{ ln('Premium ','ucwords') }}</label>
                            <input type="checkbox" class="ml-3" name="premium" id="" value="1" >
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
          url: "{{route('admin.sub_category.store',['_token'=>csrf_token()])}}",
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
              window.location.href="{{ route('admin.main_category.index') }}"
            }
          }
      });
    });



});

</script>
@endsection
