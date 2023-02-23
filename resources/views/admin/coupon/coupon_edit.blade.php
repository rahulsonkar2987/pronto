@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a admin</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Mange Admin</li>
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
                                <a href="{{route('admin.coupon.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        <form  id='FormData' method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row mx-4 mt-4">
                            <div class="form-group col-lg-6">
                                <label for="coupon_name">{{ ln('coupon_name','ucwords') }}</label>
                                <input type="text" name="coupon_name"  value="{{ $row->coupon_name }}" class="form-control" placeholder="{{ ln('coupon_name','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="discount_type">{{ ln('discount_type','ucwords') }}</label>
                              <select name="discount_type" id="" class="form-control">
                                <option value=" ">--Select type--</option>
                                <option value="Percentage" {{ $row->discount_type=='Percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="Flat" {{ $row->discount_type=='Flat' ? 'selected' : '' }}>Flat</option>
                              </select>
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="discount">{{ ln('discount','ucwords') }}</label>
                              <input type="text" name="discount" value="{{ $row->discount }}"  class="form-control" placeholder="{{ ln('discount','ucwords') }}" >
                            </div>


                            <div class="form-group col-lg-6">
                              <label for="start_time ">{{ ln('start_time ','ucwords') }}</label>
                              <input type="datetime-local" name="start_time" value="{{ $row->start_time }}"  class="form-control" placeholder="{{ ln('start_time ','ucwords') }}" >
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="end_time ">{{ ln('end_time ','ucwords') }}</label>
                              <input type="datetime-local" name="end_time" value="{{ $row->end_time }}"  class="form-control" placeholder="{{ ln('end_time ','ucwords') }}" >
                            </div>

                            <div class="col d-flex justify-content-end  form-froup mt-4">
                                  <button class="btn btn-danger  dis_btn">Save</button>
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
          url: "{{route('admin.coupon.update',[$row->id])}}",
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
              window.location.href="{{ route('admin.coupon.index') }}";
            }else if(get.action==false){
              location.reload();
            }else if(get.action=='error'){
              console.log(get.msg);
            }
          }
      });
    });



});

</script>
@endsection
