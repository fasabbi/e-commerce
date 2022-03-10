@extends('layouts.honey')

@section('body')

<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    @auth
        <!-- checkout-area start -->
        <div class="checkout-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details
                                (logged in as: {{Auth::user()->name}})
                            </h3>
                            <form action="{{ route('checkoutpost') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <p>Name *</p>
                                        <input type="text" value="{{Auth::user()->name}}" name="customer_name">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" value="{{Auth::user()->email}}" name="customer_email">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. *</p>
                                        <input type="text" value="{{Auth::user()->name}}" name="customer_phone">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Country *</p>
                                        <select name="customer_country_id" >
                                            <option value="1">Bangladesh</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>City *</p>
                                        <select name="customer_city_id" >
                                            <option value="1">Dhaka</option>
                                        </select>
                                    </div>       
                                                             {{--leaarn ajax  --}}
                                    <div class="col-12">
                                        <p>Your Address *</p>
                                        <input type="text" name="customer_address">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Postcode/ZIP</p>
                                        <input type="text" name="customer_postcode">
                                    </div>                  
                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="customer_notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                <li>cupon name <span class="pull-right"><strong>{{session('session_cupon_name') ? session('session_cupon_name'):"no cupon used"}}</strong></span></li>
                                
                                <li>cupon discount<span class="pull-right"><strong>{{session('session_cupon_discount')}}</strong></span></li>
    
                                <li>Subtotal <span class="pull-right"><strong>${{session('session_subtotal')}}</strong></span></li>
                                
                                <li>Total<span class="pull-right">${{session('session_total')}}</span></li>
                            </ul>
                            <ul class="payment-method">                            
                                <li>
                                    <input id="card" type="radio" name="payment_option" value="1" checked>
                                    <label for="card">Credit Card</label>
                                </li>
                                <li>
                                    <input id="delivery" type="radio" name="payment_option" value="2>
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button type="submit">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
        @else
        <div class=""><div class=""><div class=""><div class="">
       
            <div class="btn btn-danger">You are not logged in</div>
            <br>
            <br>
            <br>
            <div class="alert alert-success ">
                <a href="{{route('customer.login')}}">Login here</a>
            </div>
        </div></div></div></div>
    @endauth
@endsection