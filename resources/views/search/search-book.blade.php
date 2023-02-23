<?php 
  $buyBookCard = session()->get('buyBookCard');
?>
@extends('layouts.app')
@section('index')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="row align-items-center clearfix">
          <div class="col-12">
            <ul class="breadcrumbs-links">
              <li><a href="{{ route('index') }}">Home</a></li>
              <li><a href="">Search Results</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb End -->
    

    <!-- Book Listing Starts -->
    <section class="book-listing-section">
      <div class="container">
        <div class="row clearfix listing-form">

          <div class="col-12 col-md-6 ">
            <form method="GET" id="buyBooks" action="{{ route('search.buyBook') }}">
              @csrf
              <label>Buy Books</label>
              <div class="row gx-2 clearfix">
                <div class="col-9 col-md-8">
                  <input type="text" name="buyBook" id="buyBook" class="form-control" value="{{ $buyBook ?? '' }}" placeholder="Enter ISBN Title or Author here" />
                </div>
                <div class="col-3 col-md-4">
                  <input type="submit" name="submit" id="submit" value="Search" class="w-100" />
                </div>
              </div>
            </form>
          </div>

          <div class="col-12 col-md-6">
            <form action="{{ route('search.sellBook') }}"  method="GET" id="sellBooks" >
              @csrf
              <label>Sell Books</label>
              <div class="row gx-2 clearfix">
                <div class="col-9 col-md-8">
                  <input type="text" name="sellBook" id="sell" class="form-control" value="{{ $sellBook ?? '' }}" placeholder="Enter ISBN here" />
                </div>
                <div class="col-3 col-md-4">
                  <input type="submit" name="submit" id="submit" value="Search" class="w-100" />
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-12">
              <div class="search-show-area">
                <div class="search-result">
                  <p>Search results for 
                    <span>
                      @if (session()->has('error'))
                          {{ session()->get('error') }}
                      @else
                        {{ $buyBook ?? $sellBook }}
                        <?php
                          if (isset($buyBook)) {
                            $details_page= 'BookPriceRun';
                          }else{
                            $details_page= '';
                          }
                        ?>
                      @endif
                    </span>
                  </p>
                </div>
                @if (isset($buyBook))
                <div class="search-filter">
                  <select class="form-select me-3">
                    <option value="rating">Rating</option>
                    <option value="rating1">Rating</option>
                    <option value="rating2">Rating</option>
                  </select>
                  <select class="form-select">
                    <option value="pricing1">Pricing</option>
                    <option value="pricing2">Pricing</option>
                    <option value="pricing3">Pricing</option>
                  </select>
                </div>
                @endif
              </div>
          </div>
        </div>

        <div class="row clearfix">
          <div class="col-12">

            @foreach ($data as $book)
              <div class="books-container mb-4">
                <div class="row">
                  <div class="col-12 col-md-10 ">
                    <div class="book-details m-auto align-items-center">
                      <a href="{{ route('search.buyBook.Details',[$book['isbn'] ?? '','details_page'=>$details_page]) }}">
                        <img src="{{ asset($book['image']) }}" style="height: 240px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                      </a>
                        <div class="about-book">
                            <h5> <a href="{{ route('search.buyBook.Details',[ $book['isbn'] ?? '','details_page'=>$details_page]) }}">{{ $book['title'] ?? '' }}</a></h5>
                            <p>By: <span>{{ $book['author'] ?? '' }}</span></p>
                            <div class="rating">
                              <i class="bi bi-star-fill"></i>
                              <i class="bi bi-star-fill"></i>
                              <i class="bi bi-star-fill"></i>
                              <i class="bi bi-star"></i>
                              <i class="bi bi-star"></i>
                            </div>
                            <p>ISBN-13: {{ $book['isbn13'] ?? '' }}</p>
                            <p>ISBN-10: {{ $book['isbn'] ?? '' }}</p>
                            <p>Format: {{ $book['formate'] ?? 'HardCover' }}</p>
                        </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-2 text-center m-auto">
                    <div class="action-btn">
                      <h5 class="mb-3">
                        @if (isset($book['price']))
                            {{ "$".$book['price'] }}
                        @endif
                      </h5>
                      @if (isset($book['id']))
                          <a href="#" class="btn btn-outline-theme mb-3 addToCard" data-id="{{ $book['id'] }}" >Add to Cart</a>
                      @else
                          @if (isset($buyBook))
                          <a href="#" class="btn btn-outline-theme mb-3" >View Amazon</a>
                          @endif 
                      @endif
                        {{-- <a href="#" class="btn btn-outline-theme mb-3 add_to_card" data-id= {{ $book['id'] ?? '' }} data-isbn="{{ $book['isbn'] }}" >Add to Cart</a> --}}
                      <a href="" class="btn btn-outline-theme mb-3">Sell Book</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>
        </div>

        <!-- pagination start -->
        @if ($total>10)
        <div class="row clearfix">
          <div class="col-12">
            <nav aria-label="Page navigation example" class="navigation">
              <ul class="pagination justify-content-center">
                <?php 
                  $page =1;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }
                  $link1 = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page]);
                  $link2 = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page+1]);
                  $link3 = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page+2]);
                  $link4 = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page+3]);

                  $prev = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page-1]);
                  $next = route('search.buyBook',['buyBook'=>$buyBook,'page'=>$page+1]);

                ?>
                <li class="page-item">
                  <a class="page-link previous-arrow" href="{{ $prev }}" aria-label="Previous">
                    <span aria-hidden="true"><img src="{{ asset('/') }}images/Arrow 2.svg" alt="Arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="{{ $link1 }}">{{ $page }}</a></li>
                <li class="page-item"><a class="page-link" href="{{ $link2 }}">{{ $page+1 }}</a></li>
                <li class="page-item"><a class="page-link" href="{{ $link3 }}">{{ $page+2 }}</a></li>
                <li class="page-item"><a class="page-link" href="{{ $link4 }}">{{ $page+3 }}</a></li>
                <li class="page-item">
                  <a class="page-link next-arrow" href="{{ $next }}" aria-label="Next">
                    <span aria-hidden="true"><img src="{{ asset('/') }}images/Arrow next.svg" alt="Arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        @endif
        <!-- pagination end -->

      </div>
    </section>
    <!-- Book Listing Ends -->
@endsection

@section('js')
    <script>
      $(document).ready(function () {
        ////////////////////////////////////////

        // $(document).on('click','.add_to_card', function () {
        //     var id = $(this).data('id');
        //     var isbn = $thi
        // });


        ////////////////////////////////////////
      });
    </script>
@endsection