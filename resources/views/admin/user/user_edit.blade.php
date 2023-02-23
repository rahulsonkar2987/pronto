@extends('admin.layout.app')
@section('user','#e76c90');
@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a User</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">User</li>
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
                                <a href="{{route('admin.user.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        {{-- <form action="{{ route('admin.user.update',[$user->id]) }}" method="POST" enctype="multipart/form-data"> --}}
                          @method('PATCH')
                        <div class="row">
                          @csrf
                          <div class="form-group col-lg-6">
                            <label for="image">{{ ln('image','ucwords') }}</label>
                            <input type="file" name="image"  class="form-control" placeholder="{{ ln('image','ucwords') }}">
                            <img src="{{ asset($user->image) }}" style="height:60px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                          </div>


                          <div class="form-group col-lg-6">
                              <label for="first_name">{{ ln('first_name','ucwords') }}</label>
                              <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" placeholder="{{ ln('first_name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="last_name">{{ ln('last_name','ucwords') }}</label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}"  class="form-control" placeholder="{{ ln('last_name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="user_name">{{ ln('user_name','ucwords') }}</label>
                            <input type="text" name="user_name" value="{{ $user->user_name }}"  class="form-control" placeholder="{{ ln('user_name','ucwords') }}"  readonly >
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="email">{{ ln('email','ucwords') }}</label>
                            <input type="text" name="email" value="{{ $user->email }}"  class="form-control" placeholder="{{ ln('email','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="phone">{{ ln('phone','ucwords') }}</label>
                            <input type="number" name="phone" value="{{ $user->phone }}"  class="form-control" placeholder="{{ ln('phone','ucwords') }}"  maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="city">{{ ln('city','ucwords') }}</label>
                            <input type="text" name="city" value="{{ $user->city }}"  class="form-control" placeholder="{{ ln('city','ucwords') }}"  maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="pin_code">{{ ln('pin_code','ucwords') }}</label>
                            <input type="number" name="pin_code" value="{{ $user->pin_code }}" class="form-control" placeholder="{{ ln('pin_code','ucwords') }}"  maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                          </div>

                          
                          <div class="form-group col-lg-6">
                            <label for="">Gendar</label><br>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" {{ $user->gender=='Male' ? 'checked' : '' }}  value="Male">
                              <label class="form-check-label" >Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" value="Female"  {{ $user->gender=='Female' ? 'checked' : '' }} >
                              <label class="form-check-label" >Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="gender" value="Other"  {{ $user->gender=='Other' ? 'checked' : '' }}  >
                              <label class="form-check-label">Other</label>
                            </div>
                            
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="status">{{ ln('status','ucwords') }}</label>
                            <select  name="status"  class="form-control"> 
                                <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active</option>  
                                <option value="Inactive"  {{ $user->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>  
                            <select>
                          </div>


                          <div class="col-lg-6">
                            <div class="form-group">
                              <label for="password">{{ ln('password','ucwords') }}</label>
                              <input type="password" name="password"  class="form-control show_pass" placeholder="{{ ln('password','ucwords') }}" autocomplete='new-password' >
                              <a class="show_pass_btn  btn btn-sm" style="cursor: pointer">Show</a>
                            </div>
                          </div>

                        </div>


                            <div class="row col justify-content-end mt-3">
                                  <button class="btn btn-danger dis_btn">Save</button>
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
          url: "{{route('admin.user.update',[$user->id])}}",
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
              window.location.href="{{ route('admin.user.index') }}";
            }
          }
      });
    });



});

</script>
@endsection
