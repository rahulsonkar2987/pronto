@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Create a banner</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Banner</li>
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
                                <a href="{{route('admin.banner.index')}}" class="btn btn-success">Back</a>
                              </div>
                            </div>
                        </h4>

                        <form id='FormData' method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{ route("admin.banner.store") }}" method="POST" enctype="multipart/form-data"> --}}
                          @csrf

                          <div class="form-group col-lg-7">
                              <label for="image">{{ ln('image','ucwords') }}</label>
                              <input type="file" name="image" class="form-control upload_file" placeholder="Image">
                              <img id='image' src="" class="img-fluid" style="height: 50px" >
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="title">{{ ln('title1','ucwords') }}</label>
                            <input type="text" name="title"  class="form-control" placeholder="{{ ln('title','ucwords') }}">
                          </div>
                          <div class="form-group col-lg-7">
                            <label for="title2">{{ ln('title2','ucwords') }}</label>
                            <input type="text" name="title2"  class="form-control" placeholder="{{ ln('title2','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="link">{{ ln('link','ucwords') }}</label>
                            <input type="text" name="link"  class="form-control" placeholder="{{ ln('link','ucwords') }}">
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
          url: "{{route('admin.banner.store',['_token'=>csrf_token()])}}",
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
              window.location.href="{{ route('admin.banner.index') }}";
            }else if(get.action==false){
              location.reload();
            }
          }
      });
    });



});

</script>
@endsection
