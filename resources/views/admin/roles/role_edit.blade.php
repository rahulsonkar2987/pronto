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

                      {!! Form::model($role, ['method' => 'PATCH','route' => ['admin.roles.update', $role->id]]) !!}
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <strong>Name:</strong>
                                  {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <strong>Permission:</strong>
                                  <br/>
                                  @foreach($permission as $value)
                                      <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                      {{ $value->name }}</label>
                                  <br/>
                                  @endforeach
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-danger">Submit</button>
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
      formdata.append('_method', 'put');
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.manage.update',[$role->id,'_token'=>csrf_token()])}}",
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
              window.location.href="{{ route('admin.manage.index') }}";
            }
          }
      });
    });



});

</script>
@endsection
