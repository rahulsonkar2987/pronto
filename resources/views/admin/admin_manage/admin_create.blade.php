@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Create a admin</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Mange Admin</li>
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
                                <a href="{{route('admin.manage.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(array('id'=>'FormData','method'=>'POST')) !!}
                        {{-- <form action="" id='FormData' method="POST" enctype="multipart/form-data"> --}}

                          <div class="form-group col-lg-7">
                              <label for="first_name">{{ ln('first_name','ucwords') }}</label>
                              <input type="text" name="first_name"  class="form-control" placeholder="{{ ln('first_name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="last_name">{{ ln('last_name','ucwords') }}</label>
                            <input type="text" name="last_name"  class="form-control" placeholder="{{ ln('last_name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="email">{{ ln('email','ucwords') }}</label>
                            <input type="text" name="email"  class="form-control" placeholder="{{ ln('email','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="phone">{{ ln('phone','ucwords') }}</label>
                            <input type="number" name="phone"  class="form-control" placeholder="{{ ln('phone','ucwords') }}"  maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                          </div>

                          <div class="col-lg-7">
                            <div class="form-group">
                              <label for="password">{{ ln('password','ucwords') }}</label>
                              <input type="password" name="password"  class="form-control show_pass" placeholder="{{ ln('password','ucwords') }}" autocomplete='new-password' >
                            </div>
                            <a class="show_pass_btn" style="cursor: pointer">Show</a>
                          </div>

                          <div class="form-group col-lg-7 mt-3">
                            <div class="form-group">
                              <strong>Role:</strong>
                              {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                            </div>
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
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.manage.store')}}",
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
              window.location.href="{{ route('admin.manage.index') }}";
            }
          }
      });
    });



});

</script>
@endsection
