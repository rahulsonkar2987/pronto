@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a faq</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Faq</li>
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
                                <a href="{{route('admin.faq.index')}}" class="btn btn-danger">Back</a>
                              </div>
                            </div>
                        </h4>

                        {!! Form::open(['id'=>'FormData','method'=>'POST']) !!}
                        <div class="row my-5">
                            <div class="form-group col-lg-7">
                              <label for="question"><strong>{{ ln('question','ucwords') }}</strong></label>
                              <input type="text" name="question" value="{{ $row->question }}"  class="form-control" placeholder="{{ ln('question','ucwords') }}"  maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="answer"><strong>{{ ln('answer','ucwords') }}</strong></label>
                              <textarea type="text" name="answer"  class="form-control" placeholder="{{ ln('answer','ucwords') }}" cols="30" rows="10">{{ $row->answer }}</textarea>
                            </div>

                            <div class="form-group col-lg-7">
                              <label for="order_no"><strong>{{ ln('order_no','ucwords') }}</strong></label>
                              <input type="number" name="order_no" value="{{ $row->order_no }}"  class="form-control" placeholder="{{ ln('order_no','ucwords') }}">
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
          url: "{{route('admin.faq.update',[$row->id])}}",
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
              window.location.href="{{ route('admin.faq.index') }}";
            }else if(get.action==false){
              location.reload();
            }
          }
      });
    });



});

</script>
@endsection
