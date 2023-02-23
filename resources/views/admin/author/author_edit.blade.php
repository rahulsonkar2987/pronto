@extends('admin.layout.app')
@section('author','#e76c90');
@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a Author</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Author</li>
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
                                <a href="{{route('admin.author.index')}}" class="btn btn-primary">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        {{-- <form action="{{ route('admin.author.update',[$user->id]) }}" method="POST" enctype="multipart/form-data"> --}}
                          @method('PATCH')
                        <div class="row">
                          @csrf

                          <div class="form-group col-lg-7">
                              <label for="name">{{ ln('name','ucwords') }}</label>
                              <input type="text" name="name" value="{{ $author->name }}" class="form-control" placeholder="{{ ln('name','ucwords') }}">
                          </div>

                          <div class="form-group col-lg-7">
                            <label for="status">{{ ln('status','ucwords') }}</label>
                            <select  name="status"  class="form-control"> 
                                <option value="Active" {{ $author->status == 'Active' ? 'selected' : '' }}>Active</option>  
                                <option value="Inactive"  {{ $author->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>  
                            <select>
                          </div>

                        </div>


                            <div class="row col justify-content-end mt-3">
                                  <button class="btn btn-primary dis_btn">Save</button>
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
          url: "{{route('admin.author.update',[$author->id])}}",
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
            if(get.success==true){
              window.location.href="{{ route('admin.author.index') }}";
            }
          }
      });
    });



});

</script>
@endsection
