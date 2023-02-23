@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Create a Roles</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Admin</a></li>
                              <li class="breadcrumb-item">Mange Admin</li>
                              <li class="breadcrumb-item active">Create</li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          {{-- breadcrumb end here  --}}

          
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
          @endif

          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="card text-left">
                    <div class="card-body">
                      <h4 class="card-title pb-4">
                          <div class="row justify-content-between">
                            <div class="col-lg-1">
                              <a href="{{route('admin.roles.index')}}" class="btn btn-danger">Back</a>
                            </div>
                          </div>
                      </h4>

                      {{-- <form action="" id='FormData' method="POST" enctype="multipart/form-data" > --}}
                      {!! Form::open(array('route' => 'admin.roles.store','method'=>'POST')) !!}
                        <div class="form-group col-lg-7">
                            <label for="first_name"> <strong>{{ ln('Name','ucwords') }}</strong> </label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>

                        <div class="form-group col-lg-7">
                          <label for=""><strong>{{ ln('Permission','ucwords') }}:</strong></label><br/>
                          @foreach($permission as $value)
                              <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                              {{ $value->name }}</label>
                          <br/>
                          @endforeach
                        </div>

                        <div class="col-lg-12 form-froup mt-4">
                              <button class="btn btn-danger dis_btn">Save</button>
                        </div>
                      {!! Form::close() !!}

                      {{-- </form> --}}
                                  
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
          url: "{{route('admin.roles.store',['_token'=>csrf_token()])}}",
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
              window.location.href="{{ route('admin.roles.index') }}";
            }
          }
      });
    });



});

</script>
@endsection
