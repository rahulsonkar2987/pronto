@extends('layouts.app')



@section('index')

      <!-- Hero Section Starts -->

      <div class="hero" style="background: url('{{ asset($banner->image ?? '') }}') bottom center no-repeat;background-size: cover;">

        <div class="container">

          <div class="row clearfix">

            <div class="col-12">

              {{-- <h1>Welcome to <span>Pronto Bookstore</span><br />Sell or Buy Books</h1> --}}

              <h1>{{ $banner->title }}</h1>
              <h1>{{ $banner->title2 }}</h1>

              {{-- <h1>{{ $banner->title }}</h1> --}}

              <div class="form-area">

                <div class="row clearfix">

                  <div class="col-12 col-md-6 col-lg-6">

                    <form action="{{ route('search.buyBook') }}" method="GET" id="buyBooks" action="" class="form">

                      @csrf

                      <label>Buy Books</label>

                      <div class="row gx-2 clearfix">

                        <div class="col-9 col-md-8">

                          <input type="text" name="buyBook" id="buy" value="" class="form-control" placeholder="Enter ISBN Title or Author here" />

                        </div>

                        <div class="col-3 col-md-4">

                          <input type="submit" name="submit" id="submit" value="Search" class="w-100" />

                        </div>

                      </div>

                    </form>

                  </div>

                  <div class="col-12 col-md-6 col-lg-6">

                    <form action="{{ route('search.sellBook') }}" method="post" id="sellBooks" action="" class="form">

                      @csrf

                      <label>Sell Books</label>

                      <div class="row gx-2 clearfix">

                        <div class="col-9 col-md-8">

                          <input type="text" name="sellBook" id="sell" class="form-control" placeholder="Enter ISBN here" />

                        </div>

                        <div class="col-3 col-md-4">

                          <input type="submit" name="submit" id="submit" value="Search" class="w-100" />

                        </div>

                      </div>

                    </form>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <!-- Hero Section Ends -->

  

      <!-- Best Seller Section Starts -->

      <section>

        <div class="container">

          <div class="row cleaarfix">

            <div class="col-12 text-center">

              <h2>Top 10 Best Sellers</h2>

            </div>

            <div class="col-12">

              <div class="owl-carousel best-sellers">

                

                @foreach ($manageBook as $book)

                <div class="item">

                  <div class="books-grid">

                    <div class="books-image">

                      <img src="{{ asset($book->image) }}" alt="Image goes here" />

                      <div class="action animate__animated animate__fadeIn">

                        <a href="#" class="btn btn-theme">Add to Cart <i class="bi bi-cart-plus"></i></a>

                      </div>

                    </div>

                    <h4 class="book-title">{{ $book->title }}</h4>

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

      <!-- Best Seller Section Ends -->

    
  <!-- Steps to Buy Your Books Starts -->

  <section class="bg-263d4b">

    <div class="container">

      <div class="row clearfix">

        <div class="col-12 col-lg-12">

          <h2>3 Easy Steps to Buy your Book</h2>

        </div>

        <div class="col-12 col-md-4 col-lg-4">

          <div class="steps">

            <img src="images/select-img.png" alt="Image goes here" />

            <h5>1. Search for your book(s)</h5>

            <p>Look up by title or ISBN</p>

          </div>

        </div>

        <div class="col-12 col-md-4 col-lg-4">

          <div class="steps">

            <img src="images/payment-img.png" alt="Image goes here" />

            <h5>2. Buy your book</h5>

            <p>We promise to beat Amazon.com’s prices on our in-stock books. In-stock books ship fast and free - sent within one business day of purchase
              </p>

          </div>

        </div>

        <div class="col-12 col-md-4 col-lg-4">

          <div class="steps">

            <img src="images/recieve-book-img.png" alt="Image goes here" />

            <h5>3. Recieve Your Book</h5>

            <p>No-hassle 30-day return policy.</p>

          </div>

        </div>

      </div>

    </div>

  </section>

    

      <!-- Why Pronto Book Store Section Starts -->

      <section class="why-pronto">

        <div class="left-book"></div>

        <div class="right-book"></div>

        <div class="bottom-book"></div>

        <div class="container">

          <div class="row clearfix">

            <div class="col-12">

              <h2>Why Pronto Bookstore?</h2>

            </div>

            <div class="col-12 col-md-9 col-lg-8 text-start">

              <h3>Our Story</h3>

              <p>At last, a customer focused bookstore where the best books can be purchased at the lowest prices. Our

                bookstore as you see it today is over a decade in the making. It was founded on the belief that the

                customer is truly always “right.” We strive to make you smile; from the moment you land on our site to

                the moment your book arrives to your doorstep.</p>

            </div>

            <div class="col-12 col-md-3 col-lg-4">

              <img src="images/pronto-img.png" class="img-fluid w-100" alt="Image goes here" />

            </div>

          </div>

        </div>

      </section>

      <!-- Why Pronto Book Store Section Ends -->

    

    

      <!-- Steps to Buy Your Books Ends -->


            <!-- Steps to Sell Your Books Starts -->

            <section class="bg-263d4b">

              <div class="container">
      
                <div class="row clearfix">
      
                  <div class="col-12 col-lg-12">
      
                    <h2>3 Easy Steps to Sell your Book</h2>
      
                  </div>
      
                  <div class="col-12 col-md-4 col-lg-4">
      
                    <div class="steps">
      
                      <img src="images/quote-img.png" alt="Image goes here" />
      
                      <h5>1. Quote</h5>
      
                      <p>Enter ISBN(s).</p>
      
                    </div>
      
                  </div>
      
                  <div class="col-12 col-md-4 col-lg-4">
      
                    <div class="steps">
      
                      <img src="images/ship-img.png" alt="Image goes here" />
      
                      <h5>2. Ship</h5>
      
                      <p>Shipping your books to us is free.</p>
      
                    </div>
      
                  </div>
      
                  <div class="col-12 col-md-4 col-lg-4">
      
                    <div class="steps">
      
                      <img src="images/paid-img.png" alt="Image goes here" />
      
                      <h5>3. Get Paid</h5>
      
                      <p>Your money is always sent within two business days of receipt of books.</p>
      
                    </div>
      
                  </div>
      
                </div>
      
              </div>
      
            </section>
      
            <!-- Steps to Sell Your Books Ends -->
      

    

      <!-- Testimonials Section Starts -->

      <section>

        <div class="container">

          <div class="row clearfix">

            <div class="col-12">

              <h2>Customer say about Pronto Bookstore</h2>

            </div>

            <div class="col-12">

              <div class="owl-carousel testimonials">



                @foreach ($ratings as $rating)

                <div class="item">

                  <div class="test-box">

                    <p>{{ $rating->text }}</p>

                    <div class="test-author">

                      <img src="{{ asset($rating->users->image ?? 'user-defualt.png') }}" alt="Image goes here" />

                      <h6>{{ $rating->users->first_name }}  {{ $rating->users->last_name }}</h6>

                    </div>

                  </div>

                </div>

                @endforeach



              </div>

            </div>

          </div>

        </div>

      </section>

      <!-- Testimonials Section Ends -->

    

      <!-- Faq Section Starts -->

      <section class="bg-f8f9fa">

        <div class="container">

          <div class="row clearfix">

            <div class="col-12">

              <h2>Frequently Asked Questions</h2>

            </div>

            <div class="col-12 col-md-4 col-lg-4 text-center desktop">

              <img src="images/faq-img.png" class="img-fluid" alt="Image goes here" />

            </div>

            <div class="col-12 col-md-8 col-lg-8">

              <div class="faq-box">

                <ul class="questions">

                  @foreach ($faqs as $faq)

                  <li>

                    <span>{{ $faq->question }}</span>

                    {{ $faq->answer }}

                  </li>

                  @endforeach

                </ul>

              </div>

            </div>

          </div>

        </div>

      </section>

      <!-- Faq Section Ends -->

@endsection