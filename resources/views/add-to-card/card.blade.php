@extends('layouts.app')

@section('index')
<section class="breadcrumbs">
    <div class="container">
      <div class="row align-items-center clearfix">
        <div class="col-12">
          <ul class="breadcrumbs-links">
            <li><a href="">Home</a></li>
            <li>Buyer cart</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb End -->

  <!-- Cart Section Starts -->
  <section class="cart-section">
      <div class="container">
          <div class="row">
              <div class="col-12 col-lg-12 text-center">
                  <h4>Buyer cart (<span class="noOfItems">{{ count($carts) }}</span> items)</h4>
              </div>
          </div>
          <div class="row ">
              <div class="col-12 col-lg-8">

                  <!-- another-book-container -->
                  @if (count($carts)>0)
                    @foreach ($carts as  $cart)
                    <div class="books-container mb-4">
                        <div class="row">
                          <div class="col-12 col-lg-8">
                            <div class=" book-details book-details-cart">
                                <img src="{{ asset($cart->image) }}" alt="image" class="img-fluid">
                                <div class="about-book">
                                  <h5> {{ $cart->title }} </h5>
                                  <ul>
                                    <li>By: {{ $cart->author }}</li>
                                    <li>Format: {{ $cart->formate }}</li>
                                </ul>
                                </div>
                            </div>
                          </div>
                          <div class="col-12 col-lg-4">
                            <div class="remove-btn">
                              <a href="" class="cart_remove" data-id="{{ $cart->id }}">Remove <img src="{{ asset('/') }}images/btn-close.svg" alt="image"></a>
                            </div>
                            <div class="row cart-price-margin align-items-center justify-content-end clearfix">
                              <div class="col-lg-8">
                                <div class="row clearfix">
                                  <label for="quantity" class="col-sm-5 col-form-label">Quantity</label>
                                  <div class="col-sm-7">
                                    <input type="number" class="form-control add_quantity" data-id="{{ $cart->id }}" value="{{ $cart->cart_quantity }}" id="quantity">
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="cart-item-price">${{ $cart->price }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    @endforeach
                  @else 
                    <span>Empty</span>
                  @endif

                  <!-- another-book-container -->

              </div>
              <div class="col-12 col-lg-4">
                  <div class="order-suumary-container">
                      <div class="row">
                          <div class="col-12">
                            <h5>Order Summary</h5>
                          </div>
                          <div class="checkout-box">
                          <div class="row">
                            <div class="col-10 col-lg-10"><span> Price (<span class="noOfItems">{{ count($carts) }}</span> items)</span></div>
                            <div class="col-2 col-lg-2"><span class="bold">${{ $sum }}</span></div>
                          </div>
                          <div class="row">
                            <div class="col-10 col-lg-10"><span> Shipping charges</span></div>
                            <div class="col-2 col-lg-2"><span class="bold"> Free</span></div>
                          </div>
                          <div class="row">
                            <div class="col-10 col-lg-10"><span> Discount</span></div>
                            <div class="col-2 col-lg-2"><span class="bold"> $0</span></div>
                          </div>
                          <form action="">
                            <div class="row">
                              <div class="col-8 col-lg-8">
                                <input type="text" name="buy" id="buy" class="form-control" placeholder="Have a coupon" />
                              </div>
                              <div class="col-4 col-lg-4">
                                <input type="submit" name="submit" id="submit" value="Search" class="w-100" />
                              </div>
                            </div>
                          </form>
                          <div class="row">
                            <div class="col-10 col-lg-10 pb-3"><span> Coupon Discount</span></div>
                            <div class="col-2 col-lg-2"><span class="bold"> $0</span></div>
                          </div>
                        </div>

                          <div class="checkout-box">
                            <div class="row">
                              <div class="col-10 col-lg-10 pb-3"><span> Total Amount</span></div>
                              <div class="col-2 col-lg-2"><span class="bold"> ${{ $sum }}</div>
                            </div>
                            <input type="submit" name="submit" id="submit" value="Proceed to Checkout" class="w-100" />
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Cart Section End -->
@endsection