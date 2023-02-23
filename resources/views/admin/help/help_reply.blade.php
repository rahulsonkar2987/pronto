@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a help</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Help</li>
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
                                <a href="{{route('admin.help.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        <input type="hidden" name="user_id" value="{{ $row->user_id }}" >
                        <div class="row my-5">
                            <div class="form-group col-lg-7">
                              <label for="user_message"><strong>{{ ln('user_message','ucwords') }}</strong></label>
                              <textarea type="text" name="user_message"  class="form-control" placeholder="{{ ln('user_message','ucwords') }}" cols="30" rows="10" readonly >{{ $row->user_message }}</textarea>
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="admin_message"><strong>{{ ln('admin_message','ucwords') }}</strong></label>
                              <textarea type="text" name="admin_message"  class="form-control" placeholder="{{ ln('admin_message','ucwords') }}" cols="30" rows="10">{{ $row->admin_message }}</textarea>
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
      // formdata.append('_method', 'patch');
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.help.update',[$row->id])}}",
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
            if(get.success==true){
              window.location.href="{{ route('admin.help.index') }}";
            }else if(get.success==false){
              location.reload();
            }
          }
      });
    });



});

</script>
@endsection
