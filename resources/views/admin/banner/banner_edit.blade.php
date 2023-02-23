@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a Banner</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Banner</li>
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
                                <a href="{{route('admin.banner.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        <div class="row my-5">
                            <div class="col-lg-7 form-group">
                              <label for="image"><strong>File</strong></label>
                              <input type="file" name="image" class="form-control pb-3 upload_image">
                              <img  id='image' class="img-fluid" style="height: 50px" src="{{ asset($row->image ?? 'upload/user/user.png') }}" alt="">
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="title"><strong>{{ ln('title','ucwords') }}</strong></label>
                              <input type="text" name="title" value="{{ $row->title }}"  class="form-control" placeholder="{{ ln('title','ucwords') }}" >
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="title2">{{ ln('title2','ucwords') }}</label>
                              <input type="text" name="title2"  class="form-control" value="{{ $row->title2 }}" placeholder="{{ ln('title2','ucwords') }}">
                            </div>
                            <div class="form-group col-lg-7">
                              <label for="link"><strong>{{ ln('link','ucwords') }}</strong></label>
                              <input type="text" name="link" value="{{ $row->link }}"  class="form-control" placeholder="{{ ln('link','ucwords') }}">
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
          url: "{{route('admin.banner.update',[$row->id])}}",
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
