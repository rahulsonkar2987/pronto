@extends('layouts.app')
<?php 
if (isset($data['id'])) {
  if (session()->has('buyBookCard')) {
    $buyBookCard = session()->get('buyBookCard');
    if (array_key_exists($data['id'],$buyBookCard)) {
      $qnty = $buyBookCard[$data['id']]['quantity'];
    }else{
      $qnty = 1;
    }
  }
}
?>
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
      
  <!-- buy-book-section Start-->
  <section class="book-details-section desktop">
    <div class="container">
      <div class="row clearfix">
        <div class="col-12 col-md-3 col-lg-4 text-center">
          <div class="bg-f9f9f9">
              <img src="{{ asset($data['image']) }}" style="height: 350px" class="img-showcase" alt="image goes here" />
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
          <div class="book-description">
            <h3>{{ $data['title'] }}rohit</h3>
            <p>By: <span> {{ $data['author'] }}</span></p>
            <div class="rating">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star"></i>
              <i class="bi bi-star"></i><p>(4.5 Rating)</p>
            </div>
            <ul>
              <li>ISBN-13: {{ $data['isbn13'] }}</li>
              <li>ISBN-10: {{ $data['isbn'] }}</li>
              @if (!empty($data['publisher']))
                <li>Publisher: {{ $data['publisher'] }}</li>
              @endif
              @if (!empty($data['date_published']))
                <li>Released: {{ $data['date_published'] }}</li>
              @endif
              {{-- @if (!empty($data['binding'])) --}}
                {{-- <li>Format: {{ !empty($data['binding'] ? $data['binding']  : '')}} </li> --}}
                <li>Format:Hard Cover </li>
              {{-- @endif --}}
              @if (!empty($data['pages']))
                <li>pages: {{ !empty($data['pages']) ? $data['pages'].' pages' : '' }}</li>
              @endif
            </ul>

          </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3 text-center">
          <div class="action-container">
              @if (!empty($_GET['details_page']))
                <h5>$60.00</h5>
                <p class="in-stock">In stock</p>
                <div class="row gx-2 justify-content-center mb-3 quantity">
                    <label for="quantity" class="col-3 col-sm-4 col-form-label text-end">Quantity</label>
                    <div class="col-3 col-sm-3 ">
                      <input type="number" class="form-control get_quantity" id="quantity" value="{{ $qnty ?? '1' }}">
                    </div>
                    <a href="">Want More Quantity?</a>
                </div>
              @else
                <select class="form-control" name="" id="">
                    @foreach ($data['sellPrice']  as $key=>$sell_price)
                        <option value="">{{ $sell_price }} ({{ $key }})</option>
                    @endforeach
                </select>
                {{-- <p class="in-stock">In stock</p>
                <div class="row gx-2 justify-content-center mb-3 quantity">
                    <label for="quantity" class="col-3 col-sm-4 col-form-label text-end">Quantity</label>
                    <div class="col-3 col-sm-3 ">
                      <input type="number" class="form-control get_quantity" id="quantity" value="{{ $qnty ?? '1' }}">
                    </div>
                    <a href="">Want More Quantity?</a>
                </div> --}}
              @endif

              @if (isset($data['id']))
              <a href="" class="btn btn-theme w-75 mb-2 addToCard_single" data-id="{{ $data['id'] }}">Add to Cart</a>
              @else
              @if (isset($_GET['buyBook']))
                <a href="" class="btn btn-theme w-75 mb-2">View on Amazon</a>
              @endif
              @endif
              <a href="" class="btn btn-outline-theme sell-btn w-75">Sell Book</a>
          </div>
        </div>
      </div>
      <div class="row book-overview clearfix">
          <div class="col-12 col-lg-12">
              <h5>Book Overview</h5>
              <p>{{ $data['synopsis'] }}</p>
          
          </div>
      </div>
    </div>
  </section>
  <!-- buy-book-section End -->
      
  <section class="book-details-section mobile">
    <div class="container">
      <div class="row">
        <div class="book-description">
            <div class="col-12">
              <h3>{{ $data['title'] ?? '' }}</h3>
              <p>By: <span> {{ $data['author'] ?? '' }} </span></p>
                <div class="col-12">
                    <div class="rating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star"></i>
                      <i class="bi bi-star"></i><p>(4.5 Rating)</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
              <div class="bg-f9f9f9 text-center">
                <img src="{{ asset($data['image']) }}" class="img-showcase" alt="image goes here" />
              </div>
            </div>
            <ul>
              <li>ISBN-13: {{ $data['isbn13'] }}</li>
              <li>ISBN-10: {{ $data['isbn'] }}</li>
              @if (!empty($data['publisher']))
                <li>Publisher: {{ $data['publisher'] }}</li>
              @endif
              @if (!empty($data['date_published']))
                <li>Released: {{ $data['date_published'] }}</li>
              @endif
              {{-- @if (!empty($data['binding'])) --}}
                {{-- <li>Format: {{ !empty($data['binding'] ? $data['binding']  : '')}} </li> --}}
                <li>Format:Hard Cover </li>
              {{-- @endif --}}
              @if (!empty($data['pages']))
                <li>pages: {{ !empty($data['pages']) ? $data['pages'].' pages' : '' }}</li>
              @endif
            </ul>
            <div class="col-12 text-center">
              <div class="action-container">
                  <h5>$60.00</h5>
                  <p class="in-stock">In stock</p>
                  <div class="row gx-2 justify-content-center mb-3 quantity">
                      <label for="quantity" class="col-3 col-sm-4 col-form-label text-end">Quantity</label>
                      <div class="col-3 col-sm-3 ">
                        <input type="number" class="form-control get_quantity" id="quantity" value="{{ $qnty ?? '1' }}">
                      </div>
                      <a href="">Want More Quantity?</a>
                  </div>
                  @if (isset($data['id']))
                    <a href="" class="btn btn-theme w-75 mb-2 addToCard_single" data-id="{{ $data['id'] }}">Add to Cart</a>
                  @else 
                  <a href="" class="btn btn-theme w-75 mb-2">View on Amazon</a>
                  @endif
                  <a href="" class="btn btn-outline-theme sell-btn w-75">Sell Book</a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Similar Book Section Starts -->
  <section class="similar-books">
    <div class="container">
      <div class="row cleaarfix">
        <div class="col-12 text-center">
          <h2>Similar Books</h2>
        </div>
        <div class="col-12">
          <div class="owl-carousel best-sellers">
            @foreach ($similarBook as $book)
              <div class="item">
                <div class="books-grid">
                  <div class="books-image">
                    <img src="{{ asset($book->image) }}" alt="Image goes here" />
                    <div class="action animate__animated animate__fadeIn">
                      <a href="#" class="btn btn-theme mb-3 addToCard" data-id="{{ $book->id }}" >Add to Cart <i class="bi bi-cart-plus"></i></a>
                    </div>
                  </div>
                  <a href="{{ route('search.buyBook.Details',[$book->isbn]) }}">
                    <h4 class="book-title">{{ $book->title }}</h4>
                  </a>
                  <div class="book-ratings">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                  </div>
                  <div class="book-price"><i class="bi bi-currency-dollar"></i>{{ $book->price }}</div>
                </div>
              </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Similar Book Section Ends -->
      
  <!-- testimonial-customer-review start -->
  <section class="customer-review-section">
  <div class="container">
    <div class="row clearfix">
      <div class="col-12">
        <h2>Customer Review</h2>
      </div>
      <div class="col-12">
        <div class="review-conatiner">
          <div class="review-inner">
            <img src="images/william-roy.png" alt="Image" />
              <div class="review-content">
                <h5>Williams roy</h5>
                <div class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <p>(4.5 Rating)</p>
                </div>
              </div>
          </div>
          <p class="rew-txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing.</p>
        </div>
      </div>
      <div class="col-12">
        <div class="review-conatiner">
          <div class="review-inner">
            <img src="images/william-roy.png" alt="Image" />
              <div class="review-content">
                <h5>Williams roy</h5>
                <div class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <p>(4.5 Rating)</p>
                </div>
              </div>
          </div>
          <p class="rew-txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing.</p>
        </div>
      </div>
      <div class="col-12">
        <div class="review-conatiner">
          <div class="review-inner">
            <img src="images/william-roy.png" alt="Image" />
              <div class="review-content">
                <h5>Williams roy</h5>
                <div class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <p>(4.5 Rating)</p>
                </div>
              </div>
          </div>
          <p class="rew-txt">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing.</p>
        </div>
      </div>
      <div class="row text-center">
        <a href="" class="color-FFB100" > Show More</a>
      </div>
    </div>
  </div>
  </section>
  <!-- testimonial-customer-review end-->

@endsection
