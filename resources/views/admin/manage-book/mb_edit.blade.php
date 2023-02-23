@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Edit a book</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">book</li>
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
                              <div class="col-lg-2">
                                <a href="{{route('admin.manage-book.index')}}" class="btn btn-primary">Back</a>
                              </div> 
                              <div class="col-lg-2">
                                <!-- Button trigger modal -->
                                <a href="#" class="btn btn-primary btn-lg ml-5 model_isbn">
                                  Get Data
                                </a>
                              </div>
                            </div>
                        </h4>

                        <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-paperback-tab" data-toggle="tab" href="#nav-paperback" role="tab" aria-controls="nav-paperback" aria-selected="true">PapperBack</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-hardcover" role="tab" >HardCover</a>
                          </div>
                        </nav>
                        <div class="tab-content mt-3" id="nav-tabContent">
                          <div class="tab-pane fade show active paperback_tab" id="nav-paperback" role="tabpanel">
                            <form class='FormData' method="POST" enctype="multipart/form-data">
                              {{-- <form action="{{ route("admin.manage-book.update",[$manageBook->id]) ?? '' }}" method="POST" enctype="multipart/form-data"> --}}
                                {{-- @csrf --}}
                                {{-- @method('PATCH') --}}
                              <input type="hidden" name="id" value="{{ $paperback['id'] ?? '' }}">
                              <input type="hidden" name="formate" value="Paperback">
                              <input type="hidden" name="action"  value="{{ empty($paperback) ? 'new' : 'old' }}">
                              <input type="hidden" name="formate_id" value="{{ $hardcover['formate_id'] ?? '' }}">
                              <div class="row input">
    
                                  <div class="form-group col-lg-6">
                                    <label for="image">{{ ln('image','ucwords') }}</label>
                                    <input type="file" name="image" class="form-control upload_file" placeholder="Image">
                                    <input type="hidden" name="isbn_image_Upload" id="isbn_image_Upload">
                                    <img id='image'  src="{{ asset($paperback['image'] ?? '') }}"  class="img-fluid" style="height: 50px" >
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="title">{{ ln('title','ucwords') }}</label>
                                    <input type="text" name="title" value=" {{$paperback['title'] ?? ''}} "  class="form-control isbn_title"  placeholder="{{ ln('title','ucwords') }}">
                                  </div>
                                  <div class="form-group col-lg-6">
                                    <label for="isbn">{{ ln('isbn','ucwords') }}</label>
                                    <input type="text" name="isbn"   value="{{ $paperback['isbn'] ?? '' }}"  class="form-control isbn"  placeholder="{{ ln('isbn','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="isbn10">{{ ln('isbn10','ucwords') }}</label>
                                    <input type="text" name="isbn10"   value="{{ $paperback['isbn10'] ?? '' }}"  class="form-control isbn10"  placeholder="{{ ln('isbn10','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="isbn13">{{ ln('isbn13','ucwords') }}</label>
                                    <input type="text" name="isbn13"   value="{{ $paperback['isbn13'] ?? '' }}"  class="form-control isbn13"  placeholder="{{ ln('isbn13','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="main_category_id">{{ ln('main_category','ucwords') }}</label>
                                    <select name="main_category_id" id=""  class="form-control main_category_id">
                                      <option value="">--Select Main Category</option>
                                      @foreach ($mc as $category)
                                          <option value="{{ $category->id }}"  @if(isset($paperback['main_category_id'])) {{ $paperback['main_category_id']==$category->id ? 'selected' :  '' }} @endif>{{ $category->main_category_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="sub_category_id">{{ ln('sub_category','ucwords') }}</label>
                                    <select name="sub_category_id" id="" class="form-control sub_category" >
                                      <option value="">--Select Main Category</option>
                                      @foreach ($sc as $category)
                                          <option value="{{ $category->id }}"  @if(isset($paperback['sub_category_id'])) {{ $paperback['sub_category_id']== $category->id ? 'selected' :  '' }} @endif>{{ $category->sub_category_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="authors">{{ ln('authors','ucwords') }}</label>
                                    <input type="text" name="author"   value="{{ $paperback['author'] ?? '' }}"  class="form-control isbn_authors" placeholder="{{ ln('authors','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="language">{{ ln('language','ucwords') }}</label>
                                    <input type="text" name="language"   value="{{ $paperback['language'] ?? '' }}"  class="form-control isbn_language" placeholder="{{ ln('language','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="edition">{{ ln('edition','ucwords') }}</label>
                                    <input type="text" name="edition"   value="{{ $paperback['edition'] ?? '' }}"  class="form-control isbn_edition" placeholder="{{ ln('edition','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="publisher">{{ ln('publisher','ucwords') }}</label>
                                    <input type="text" name="publisher"   value="{{ $paperback['publisher'] ?? '' }}"  class="form-control isbn_publisher" placeholder="{{ ln('publisher','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="date_published">{{ ln('date_published','ucwords') }}</label>
                                    <input type="text" name="date_published"   value="{{ $paperback['date_published'] ?? '' }}"  class="form-control isbn_date_published" placeholder="{{ ln('date_published','ucwords') }}">
                                  </div>
    
    
                                  <div class="form-group col-lg-6">
                                    <label for="dimensions">{{ ln('dimensions','ucwords') }}</label>
                                    <input type="text" name="dimensions" class="form-control isbn_dimensions" placeholder="{{ ln('dimensions','ucwords') }}">
                                  </div>


                                  <div class="form-group col-lg-6">
                                    <label for="condition">{{ ln('condition','ucwords') }}</label>
                                    <select name="condition" class="form-control">
                                      <option value="New"  @if(isset($paperback['condition'])) {{ $paperback['condition']=='New' ? 'selected' :  '' }} @endif>New</option>
                                      <option value="Like New" @if(isset($paperback['condition']))  {{ $paperback['condition']== 'Like New' ? 'selected' :  '' }} @endif>Like New</option>
                                      <option value="Good" @if(isset($paperback['condition']))  {{ $paperback['condition']=='Good' ? 'selected' :  '' }} @endif>Good</option>
                                      <option value="Acceptable" @if(isset($paperback['condition']))  {{ $paperback['condition']=='Acceptable' ? 'selected' :  '' }} @endif>Acceptable</option>
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="pages">{{ ln('pages','ucwords') }}</label>
                                    <input type="number" name="pages"   value="{{ $paperback['pages'] ?? '' }}"  class="form-control isbn_page" placeholder="{{ ln('pages','ucwords') }}">
                                  </div>


                                  <div class="form-group col-lg-6">
                                    <label for="quantity">{{ ln('quantity','ucwords') }}</label>
                                    <input type="number" name="quantity"   value="{{ $paperback['quantity'] ?? '' }}"   class="form-control" placeholder="{{ ln('quantity','ucwords') }}">
                                  </div>

                                  <div class="form-group form-check col-lg-6">
                                    <label for="popular">{{ ln('popular','ucwords') }}</label>
                                    <br>
                                    <label class="form-check-label pl-3">
                                      <input type="checkbox" class="form-check-input" name="popular" value="1" @if(isset($paperback['popular']))  {{ $paperback['popular']=='1' ? 'checked' : '' }}  @endif placeholder="{{ ln('popular','ucwords') }}">
                                      Yes
                                    </label>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="price">{{ ln('price','ucwords') }}</label>
                                    <input type="number" name="price"   value="{{ $paperback['price'] ?? '' }}"    class="form-control" placeholder="{{ ln('price','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="status">{{ ln('status','ucwords') }}</label>
                                    <select name="status" id="" class="form-control">
                                      <option value="Active"   @if(isset($paperback['status'])) {{ $paperback['status']=='Active' ? 'selected' : '' }} @endif>Active</option>
                                      <option value="Inactive" @if(isset($paperback['status']))  {{ $paperback['status']=='Inactive' ? 'selected' : '' }} @endif>Inactive</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="row col mt-3  justify-content-end">
                                <button class="btn btn-primary dis_btn">Save</button>
                              </div>
                            </form>
                          </div>
                          <div class="tab-pane fade hardback_tab" id="nav-hardcover" role="tabpanel">
                            <form class='FormData' method="POST" enctype="multipart/form-data">
                              {{-- <form action="{{ route("admin.manage-book.store") }}" method="POST" enctype="multipart/form-data"> --}}
                                <input type="hidden" name="formate" value="Hardcover">
                                <input type="hidden" name="id" value="{{ $hardcover['id'] ?? '' }}">
                                <input type="hidden" name="action" value="{{ empty($hardcover) ? 'new' : 'old' }}">
                                <input type="hidden" name="formate_id" value="{{ $paperback['formate_id'] ?? '' }}">
                              <div class="row input">
    
                                  <div class="form-group col-lg-6">
                                    <label for="image">{{ ln('image','ucwords') }}</label>
                                    <input type="file" name="image" class="form-control upload_file" placeholder="Image">
                                    <input type="hidden" name="isbn_image_Upload" id="isbn_image_Upload">
                                    <img id='image'  src="{{ asset($hardcover['image'] ?? '') ?? '' }}"  class="img-fluid" style="height: 50px" >
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="title">{{ ln('title','ucwords') }}</label>
                                    <input type="text" name="title" value=" {{$hardcover['title'] ?? ''}} "  class="form-control isbn_title"  placeholder="{{ ln('title','ucwords') }}">
                                  </div>
                                  <div class="form-group col-lg-6">
                                    <label for="isbn">{{ ln('isbn','ucwords') }}</label>
                                    <input type="text" name="isbn"   value="{{ $hardcover['isbn'] ?? '' }}"  class="form-control isbn"  placeholder="{{ ln('isbn','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="isbn10">{{ ln('isbn10','ucwords') }}</label>
                                    <input type="text" name="isbn10"   value="{{ $hardcover['isbn10'] ?? '' }}"  class="form-control isbn10"  placeholder="{{ ln('isbn10','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="isbn13">{{ ln('isbn13','ucwords') }}</label>
                                    <input type="text" name="isbn13"   value="{{ $hardcover['isbn13'] ?? '' }}"  class="form-control isbn13"  placeholder="{{ ln('isbn13','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="main_category_id">{{ ln('main_category','ucwords') }}</label>
                                    <select name="main_category_id" id=""  class="form-control main_category_id">
                                      <option value="">--Select Main Category</option>
                                      @foreach ($mc as $category)
                                          <option value="{{ $category->id }}"  @if(isset($hardcover['main_category_id']))  {{ $hardcover['main_category_id']== $category->id ? 'selected' :  '' }} @endif >{{ $category->main_category_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="sub_category_id">{{ ln('sub_category','ucwords') }}</label>
                                    <select name="sub_category_id" id="" class="form-control sub_category" >
                                      <option value="">--Select Main Category</option>
                                      @foreach ($sc as $category)
                                          <option value="{{ $category->id }}"  @if(isset($hardcover['sub_category_id']))  {{ $hardcover['sub_category_id']==$category->id ? 'selected' :  '' }} @endif>{{ $category->sub_category_name }}</option>
                                      @endforeach
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="authors">{{ ln('authors','ucwords') }}</label>
                                    <input type="text" name="author"   value="{{ $hardcover['author'] ?? '' }}"  class="form-control isbn_authors" placeholder="{{ ln('authors','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="language">{{ ln('language','ucwords') }}</label>
                                    <input type="text" name="language"   value="{{ $hardcover['language'] ?? '' }}"  class="form-control isbn_language" placeholder="{{ ln('language','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="edition">{{ ln('edition','ucwords') }}</label>
                                    <input type="text" name="edition"   value="{{ $hardcover['edition'] ?? '' }}"  class="form-control isbn_edition" placeholder="{{ ln('edition','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="publisher">{{ ln('publisher','ucwords') }}</label>
                                    <input type="text" name="publisher"   value="{{ $hardcover['publisher'] ?? '' }}"  class="form-control isbn_publisher" placeholder="{{ ln('publisher','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="date_published">{{ ln('date_published','ucwords') }}</label>
                                    <input type="text" name="date_published"   value="{{ $hardcover['date_published'] ?? '' }}"  class="form-control isbn_date_published" placeholder="{{ ln('date_published','ucwords') }}">
                                  </div>
    
    
                                  <div class="form-group col-lg-6">
                                    <label for="dimensions">{{ ln('dimensions','ucwords') }}</label>
                                    <input type="text" name="dimensions"  value="{{ $hardcover['dimensions'] ?? '' }}"  class="form-control isbn_dimensions" placeholder="{{ ln('dimensions','ucwords') }}">
                                  </div>

                                  
                                  <div class="form-group col-lg-6">
                                    <label for="condition">{{ ln('condition','ucwords') }}</label>
                                    <select name="condition" class="form-control">
                                      <option value="New"  @if(isset($hardcover['condition'])) {{ $hardcover['condition']=='New' ? 'selected' :  '' }} @endif>New</option>
                                      <option value="Like New" @if(isset($hardcover['condition']))  {{ $hardcover['condition']== 'Like New' ? 'selected' :  '' }} @endif>Like New</option>
                                      <option value="Good" @if(isset($hardcover['condition']))  {{ $hardcover['condition']=='Good' ? 'selected' :  '' }} @endif>Good</option>
                                      <option value="Acceptable" @if(isset($hardcover['condition']))  {{ $hardcover['condition']=='Acceptable' ? 'selected' :  '' }} @endif>Acceptable</option>
                                    </select>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="pages">{{ ln('pages','ucwords') }}</label>
                                    <input type="number" name="pages"   value="{{ $hardcover['pages'] ?? '' }}"  class="form-control isbn_page" placeholder="{{ ln('pages','ucwords') }}">
                                  </div>

                                  <div class="form-group col-lg-6">
                                    <label for="quantity">{{ ln('quantity','ucwords') }}</label>
                                    <input type="number" name="quantity" value="{{ $hardcover['quantity'] ?? '' }}"   class="form-control" placeholder="{{ ln('quantity','ucwords') }}">
                                  </div>

                                  <div class="form-group form-check col-lg-6">
                                    <label for="popular">{{ ln('popular','ucwords') }}</label>
                                    <br>
                                    <label class="form-check-label pl-3">
                                      <input type="checkbox" class="form-check-input" name="popular" value="1" @if(isset($hardcover['popular']))  {{ $hardcover['popular']=='1' ? 'checked' : '' }}  @endif placeholder="{{ ln('popular','ucwords') }}">
                                      Yes
                                    </label>
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="price">{{ ln('price','ucwords') }}</label>
                                    <input type="number" name="price"   value="{{ $hardcover['price'] ?? '' }}"  class="form-control" placeholder="{{ ln('price','ucwords') }}">
                                  </div>
    
                                  <div class="form-group col-lg-6">
                                    <label for="status">{{ ln('status','ucwords') }}</label>
                                    <select name="status" id="" class="form-control">
                                      <option value="Active"   @if(isset($hardcover['status'])) {{ $hardcover['status']=='Active' ? 'selected' : '' }} @endif>Active</option>
                                      <option value="Inactive" @if(isset($hardcover['status']))  {{ $hardcover['status']=='Inactive' ? 'selected' : '' }} @endif>Inactive</option>

                                    </select>
                                  </div>
                              </div>
                              <div class="row col mt-3  justify-content-end">
                                <button class="btn btn-primary dis_btn">Save</button>
                              </div>
                            </form>

                          </div>
                          
                        </div>
                                    
                      </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- get isbn model open here -->
        <div class="modal fade show_model_isbn" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Book Data</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">


                <div class="row justify-content-center isbn_no_row">
                  <div class="col-lg-12 mx-2">
                    <div class="form-group">
                      <label for="" style="font-size:14px">ISBN No.</label>
                      <input type="text" name="" id="isbn_no" class="form-control form-control-sm" placeholder="Please Entere the ISBN" aria-describedby="helpId">
                    </div>
                  </div>
                </div>
                <div class="row_book_info d-none">
                  <div class="row clearfix">
                    <div class="col-6">
                      <p class="book-details">Title: <span id="isbn_title"></span></p>
                      <p class="book-details">ISBN: <span id="isbn"></span></p>
                      <p class="book-details">ISBN10: <span id="isbn10"></span></p>
                      <p class="book-details">ISBN13: <span id="isbn13"></span></p>
                      <p class="book-details">Author: <span id="isbn_authors"></span></p>
                      <p class="book-details">Language: <span id="isbn_language"></span></p>
                      <p class="book-details">Edition: <span id="isbn_edition"></span></p>
                      <p class="book-details">Publisher: <span id="isbn_publisher"></span></p>
                      <p class="book-details">Published date: <span id="isbn_date_published"></span></p>
                      <p class="book-details">Dimension: <span id="isbn_dimensions"></span></p>
                      <p class="book-details">Pages: <span id="isbn_page"></span></p>
                    </div>
                    <div class="col-6">
                      {{-- <strong>Image</strong> --}}
                      <img id="isbn_image" src="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary get_data">Get Data</button>
                <button type="button" class="btn btn-primary insert_data">Insert</button>
              </div>
            </div>
          </div>
        </div>
        <!-- get isbn model open end -->
        
        
    </div>
@endsection
@section('js');
<script>
    $(document).ready(function(){

    $('.FormData').submit(function(e){
      e.preventDefault();
      $('.dis_btn').prop('disabled',true);
      var formdata = new FormData(this);
      var id = formdata.get('id');
      formdata.append('_token', '{{ csrf_token() }}');
      $(document).find("span.error").remove();

      if (formdata.get('action')=='new') {
        var rt = "{{route('admin.manage-book.store')}}";
      }else if(formdata.get('action')=='old'){
        formdata.append('_method', 'patch');
        rt ="{{route('admin.manage-book.update','')}}"+'/'+id;
      }
      var th = this;
      $.ajax({
          url: rt,
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            // getError(jqXHR,get_error);
            $(".dis_btn").prop('disabled',false);
            if (jqXHR.status === 0) {
                alert('Not connect! please Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500]');
            } else if (get_error === 'parsererror') {
                alert('Requested JSON parse failed');
            } else if (get_error === 'timeout') {
                alert('Time out error');
            } else if (get_error === 'abort') {
                alert('Ajax request aborted.');
            }else{
                $.each(jqXHR.responseJSON.errors,function(field_name,error){
                    $(th).find('[name='+field_name+']').after('<span class="text-strong d-block text-danger error">' +error+ '</span>');
                });
            }
          },
          success: function(get){
            $('.dis_btn').prop('disabled',false);
            // console.log(get.data);
            if(get.success==true){
              window.location.href="{{ route('admin.manage-book.index') }}";
            }else if(get.success==false){
              location.reload();
            }
          }
      });
    });

    $(document).on('change','.main_category_id', function () {
      var main_category_id = $('.main_category_id option:selected').val();
      $.ajax({
        type: "get",
        url: "{{ route('admin.fetchSubCategory') }}",
        data: {main_category_id:main_category_id},
        success: function (get) {
          console.log(get);
          $('.sub_category').html(get.data);
        }
      });
    });


  // show model isbn start here 
      $(".model_isbn").click(function (e) { 
      e.preventDefault();
      $('.isbn_no_row').removeClass('d-none');
      $('.show_model_isbn').modal();
    });
    // show model isbn end here


    function loadIsbnData(get_data,set){
      $.ajax({
        type: "get",
        url: "{{ route('admin.getBookData') }}",
        data:{isbn:get_data},
        success: function (get) {
          $('.isbn_no_row').addClass('d-none');
          $('.row_book_info').removeClass();
          console.log(get);

          const {authors,date_published,dimensions,edition,image,isbn,isbn10,isbn13,language,msrp,pages,publisher,title,title_long}=get.data[0];

          if (set=='input') {
            if ($('.paperback_tab').hasClass('active')) {
              var cls ='.paperback_tab';
            }else{
              cls = '.hardback_tab';
            }
            $(cls+' .input #isbn_image_Upload').attr("value",image);
            $(cls+' .input #image').attr("src",image);
            $(cls+' .input .isbn_title').val(title);
            $(cls+' .input .isbn').val(isbn);
            $(cls+' .input .isbn10').val(isbn10);
            $(cls+' .input .isbn13').val(isbn13);
            $(cls+' .input .isbn_authors').val(authors);
            $(cls+' .input .isbn_language').val(language);
            $(cls+' .input .isbn_edition').val(edition);
            $(cls+' .input .isbn_publisher').val(publisher);
            $(cls+' .input .isbn_date_published').val(date_published);
            $(cls+' .input .isbn_dimensions').val(dimensions);
            $(cls+' .input .isbn_page').val(pages);
          }else if (set=='model'){
            $('#isbn_image').attr('src',image);
            $('#isbn_title').html(title);
            $('#isbn').html(isbn);
            $('#isbn10').html(isbn10);
            $('#isbn13').html(isbn13);
            $('#isbn_authors').html(authors);
            $('#isbn_language').html(language);
            $('#isbn_edition').html(edition);
            $('#isbn_publisher').html(publisher);
            //  var date = new Date(date_published*1000);
            $('#isbn_date_published').html(date_published);
            $('#isbn_dimensions').html(dimensions);
            $('#isbn_page').html(pages);
          }
        }
      });

    }

    $('.get_data').click(function (e) { 
      e.preventDefault();
      var get_data = $('#isbn_no').val();
      loadIsbnData(get_data,'model')
    });

    $('.insert_data').click(function (e) { 
      e.preventDefault();
      var get_data = $('#isbn_no').val();
      loadIsbnData(get_data,'input');
      $('.show_model_isbn').modal('hide');
    });




});

</script>
@endsection
