@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">
            <!-- Begin Page Header-->
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Change Password</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item">Setting</li>
                                <li class="breadcrumb-item active">Password change</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card text-left">
                      <img class="card-img-top" src="holder.js/100px180/" alt="">
                      <div class="card-body">
                        <h4 class="card-title pb-4">
                            <div class="row justify-content-between">
                              <div class="col-lg-1">
                                <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Back</a>
                              </div>
                            </div>
                        </h4>

                        <form  id='formData' method="POST" >
                          <div class="row">

                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="name">Old password</label>
                                    <input type="text" name="current_password" id="name" class="form-control" minlength="3" maxlength="50" placeholder="Old password">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="name">New password</label>
                                    <input type="text" name="password" id="name" class="form-control" minlength="3" maxlength="50" placeholder="New password">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="name">password confirmation</label>
                                    <input type="text" name="password_confirmation" id="name" class="form-control" minlength="3" maxlength="50" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="col-lg-12">
                              <div class="form-froup">
                                <button class="btn btn-primary">Change</button>
                              </div>
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

    $('#formData').submit(function(e){
      e.preventDefault();
      var formdata = new FormData(this);
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.password.update',['_token'=>csrf_token()])}}",
          type: "post",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            getError(jqXHR,get_error);
          },
          success: function(get){
              console.log(get.data);
              if(get.data=='saved'){
                  location.reload();
              }else if(get.data=='unsaved'){
                  location.reload();
              }
          }
      });
    });



});

</script>
@endsection
