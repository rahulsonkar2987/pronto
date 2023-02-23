@extends('admin.layout.app')
<style type="text/css">
  .book-details {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    justify-content: space-between;
  }
  .book-details span {
    text-align: end;
  }
</style>
@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
              <div class="page-header">
                  <div class="d-flex align-items-center">
                      <h2 class="page-header-title">Create a book</h2>
                      <div>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                              <li class="breadcrumb-item">Book</li>
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

                        <form id='FormData' method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{ route("admin.manage-book.store") }}" method="POST" enctype="multipart/form-data"> --}}
                          {{-- @csrf --}}
                          <div class="row input">

                            <div class="form-group col-lg-6">
                              <label for="formate">{{ ln('format','ucwords') }}</label>
                              <select name="formate" class="form-control">
                                <option value="Paperback">Paperback</option>
                                <option value="Hardcover">Hardcover</option>
                              </select>
                            </div>


                            <div class="form-group col-lg-6">
                              <label for="image">{{ ln('image','ucwords') }}</label>
                              <input type="file"  name="image" class="form-control upload_file isbn_image" placeholder="Image">
                              <input type="hidden" name="isbn_image_Upload" id="isbn_image_Upload">
                              <img id='image' src="" class="img-fluid" style="height: 80px" >
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="title">{{ ln('title','ucwords') }}</label>
                              <input type="text" name="title"   class="form-control isbn_title" placeholder="{{ ln('title','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="isbn">{{ ln('isbn','ucwords') }}</label>
                              <input type="text" name="isbn"  class="form-control isbn" placeholder="{{ ln('isbn','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="isbn10">{{ ln('isbn10','ucwords') }}</label>
                              <input type="text" name="isbn10"  class="form-control isbn10" placeholder="{{ ln('isbn10','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="isbn13">{{ ln('isbn13','ucwords') }}</label>
                              <input type="text" name="isbn13"  class="form-control isbn13" placeholder="{{ ln('isbn13','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="main_category_id">{{ ln('main_category','ucwords') }}</label>
                              <select name="main_category_id" id="" class="form-control main_category_id">
                                <option value="">--Select Main Category</option>
                                @foreach ($mc as $category)
                                    <option value="{{ $category->id }}">{{ $category->main_category_name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="sub_category_id">{{ ln('sub_category','ucwords') }}</label>
                              <select name="sub_category_id" id="" class="form-control sub_category" >
                                <option value="">--Select Main Category</option>
                              </select>
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="authors">{{ ln('authors','ucwords') }} </label>
                              <input type="text" name="author" class="form-control isbn_authors" placeholder="Author Name">

                              {{-- <a id="show_author_model" class="btn btn-sm btn-outline-primary"  href="">Add Author</a></label>
                              <select name="author_id"  class="form-control" id='author_name' >
                                <option value=" ">--Select One</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                              </select> --}}
                            </div>
                            
                            <div class="form-group col-lg-6">
                              <label for="language">{{ ln('language','ucwords') }}</label>
                              <input type="text" name="language"  class="form-control isbn_language" placeholder="{{ ln('language','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="edition">{{ ln('edition','ucwords') }}</label>
                              <input type="text" name="edition"  class="form-control isbn_edition" placeholder="{{ ln('edition','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="publisher">{{ ln('publisher','ucwords') }}</label>
                              <input type="text" name="publisher"  class="form-control isbn_publisher" placeholder="{{ ln('publisher','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="date_published">{{ ln('date_published','ucwords') }}</label>
                              <input type="text" name="date_published"  class="form-control isbn_date_published" placeholder="{{ ln('date_published','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="dimensions">{{ ln('dimensions','ucwords') }}</label>
                              <input type="text" name="dimensions"  class="form-control isbn_dimensions" placeholder="{{ ln('dimensions','ucwords') }}">
                            </div>


                            {{-- <div class="form-group col-lg-6">
                              <label for="dimensions">{{ ln('dimensions','ucwords') }}</label>
                              <div class="row">
                                <div class="input-group mb-2   col-sm-3">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">Width</div>
                                  </div>
                                  <input type="text" name='width' class="form-control"  placeholder="Width">
                                </div>
                                <div class="input-group mb-2 col-sm-3">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">Height</div>
                                  </div>
                                  <input type="text" name="height" class="form-control"  placeholder="Height">
                                </div>
                                <div class="input-group mb-2 col-sm-3">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">Weight</div>
                                  </div>
                                  <input type="text" name="length" class="form-control"  placeholder="Weight">
                                </div>
                                <div class="input-group mb-2 col-sm-3">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">Length</div>
                                  </div>
                                  <input type="text" name="weight" class="form-control"  placeholder="Length">
                                </div>
                              </div>
                            </div> --}}

                            <div class="form-group col-lg-6">
                              <label for="condition">{{ ln('condition','ucwords') }}</label>
                              <select name="condition" class="form-control">
                                <option value="New">New</option>
                                <option value="Like New">Like New</option>
                                <option value="Good">Good</option>
                                <option value="Acceptable">Acceptable</option>
                              </select>
                            </div>


                            <div class="form-group col-lg-6">
                              <label for="pages">{{ ln('pages','ucwords') }}</label>
                              <input type="number" name="pages"  class="form-control isbn_page" placeholder="{{ ln('pages','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="quantity">{{ ln('quantity','ucwords') }}</label>
                              <input type="number" name="quantity"  class="form-control" placeholder="{{ ln('quantity','ucwords') }}">
                            </div>




                            <div class="form-group form-check">
                              <label for="popular">{{ ln('popular','ucwords') }}</label>
                              <br>
                              <label class="form-check-label pl-3">
                                <input type="checkbox" class="form-check-input" name="popular" value="1" placeholder="{{ ln('popular','ucwords') }}">
                                Yes
                              </label>
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="price">{{ ln('price','ucwords') }}</label>
                              <input type="number" name="price"  class="form-control" placeholder="{{ ln('price','ucwords') }}">
                            </div>

                            <div class="form-group col-lg-6">
                              <label for="status">{{ ln('status','ucwords') }}</label>
                              <select name="status" id="" class="form-control">
                                <option value="Active">Active</option>
                                <option value="INactive">Inactive</option>
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


        <!-- author  Modal open here  -->
        <div class="modal fade" id="open_author_model" tabindex="-1" >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Author</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body mx-2">
                <form  id='AuthorFormData' method="POST" enctype="multipart/form-data">
                    <div class="row mt-2">
                      @csrf

                      <div class="form-group col-lg-12">
                          <label for="name">{{ ln('name','ucwords') }}</label>
                          <input type="text" name="name"  class="form-control" placeholder="{{ ln('name','ucwords') }}">
                      </div>

                      <div class="form-group col-lg-12">
                        <label for="status">{{ ln('status','ucwords') }}</label>
                        <select  name="status"  class="form-control"> 
                            <option value="Active">Active</option>  
                            <option value="Inactive">Inactive</option>  
                        <select>
                      </div>

                    </div>

                    <div class="row col justify-content-end mt-3">
                      <button class="btn btn-primary dis_btn">Save</button>
                    </div>

                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- author  Modal open end  -->


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

    $('#FormData').submit(function(e){
      e.preventDefault();
      $('.dis_btn').prop('disabled',true);
      var formdata = new FormData(this);
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.manage-book.store',['_token'=>csrf_token()])}}",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            getError(jqXHR,get_error);
          },
          success: function(get){
            if(get.success==true){
              window.location.href="{{ route('admin.manage-book.index') }}";
            }else if(get.success==false){
              location.reload();
            }
          }
      });
    });

    // load sub category start here 
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
    /// load sun category end here


    // show modal author start here 
    $("#show_author_model").click(function (e) { 
      e.preventDefault();
      $('#open_author_model').modal('show');
    });
    // show model author end here 

    // add author name start here 
    $('#AuthorFormData').submit(function(e){
      e.preventDefault();
      
      $('.dis_btn').prop('disabled',true);
      var formdata = new FormData(this);
      $(this).trigger("reset");
      $(document).find("span.error").remove();
      $.ajax({
          url: "{{route('admin.author.store')}}",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
          dataType: 'json',
          error:function (jqXHR,get_error) {
            getError(jqXHR,get_error);
          },
          success: function(get){
            if(get.success==true){
              //// load author name 
              $.ajax({
                type: "get",
                url: "{{ route('admin.loadAuthorName') }}",
                success: function (get) {
                  console.log(get);
                  $("#author_name").html(get.data);
                }
              });
              ////// load end author here

              $('#open_author_model').modal('hide');
              setTimeout(() => {
                alert('Author name has been added successfully');
                setTimeout(() => {
                  <?php 
                    if(session()->has('MESSAGE')){
                      session()->forget('MESSAGE');
                    }
                  ?>
                }, 1000);
              },1000);
            $('.dis_btn').prop('disabled',false);
            }else if(get.success==false){
              location.reaload();
            }
          }
      });

    });
    // add author name end here  

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
            $('.input #isbn_image_Upload').attr("value",image);
            $('.input #image').attr("src",image);
            $('.input .isbn_title').val(title);
            $('.input .isbn').val(isbn);
            $('.input .isbn10').val(isbn10);
            $('.input .isbn13').val(isbn13);
            $('.input .isbn_authors').val(authors);
            $('.input .isbn_language').val(language);
            $('.input .isbn_edition').val(edition);
            $('.input .isbn_publisher').val(publisher);
            $('.input .isbn_date_published').val(date_published);
            $('.input .isbn_dimensions').val(dimensions);
            $('.input .isbn_page').val(pages);
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
