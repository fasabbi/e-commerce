@extends('layouts.honey')

@section('body')
<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('updatecart')}} "
                    method="POST"> 
                    @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
 
@php
    $subtotal = 0;
@endphp

@foreach ($carts as $mmm)
<tr>
<td class="images"><img src="{{asset('uploads/product')}}/
{{$mmm->relationtoproducttable->product_photo}}" 
alt="not found"></td>
<td class="product">
<a href="single-product.html">
    {{$mmm->relationtoproducttable->product_name }}

{{-- {{App\Models\Product::find($mmm->product_id)->product_name}} --}}

@if ($mmm->relationtoproducttable->product_quantity < $mmm->quantity)

<span class="badge badge-danger"> out of stock</span>

    
@endif


</a>
</td>
<td class="ptice">$
{{$mmm->relationtoproducttable->product_price }}
    {{-- {{App\Models\Product::find($mmm->product_id)->product_price}} --}}
</td>
<td class="quantity cart-plus-minus">
<input type="text" value="{{$mmm->quantity}}"  name="quantity[{{$mmm->id}}]"/>
</td>
<td class="total">${{$mmm->relationtoproducttable->product_price *$mmm->quantity}}</td>
@php
    $subtotal += $mmm->relationtoproducttable->product_price *$mmm->quantity;
@endphp
<td class="remove">
<a href="{{url('cart/delete')}}/{{$mmm->id}}">
<i class="fa fa-times"></i>     
</a> 
</td>
</tr>

@endforeach
                                
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                        <li><a href="{{url('shop')}}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
<div class="cupon-wrap">
<input type="text" placeholder="Cupon Code" id="apply_cupon_input" value="{{$cupon_name}}">
<button type="button" id="apply_cupon_btn">Apply Cupon</button>

@if (session('error'))
<div class="alert alert-danger">
{{session('error')}}
</div>
@endif
    
</div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                    <li><span class="pull-left">Subtotal </span>${{$subtotal}}</li>
                                    <li><span class="pull-left">-Discount(%) </span>{{$cupon_discount }}%</li>
                                    <li><span class="pull-left"> Total </span> ${{$subtotal-(($subtotal* $cupon_discount)/100) }}</li>
                                    @php
                                        session([
                                            'session_cupon_name'=>$cupon_name,
                                            'session_subtotal'=>$subtotal,
                                            'session_cupon_discount'=>$cupon_discount,
                                            'session_total'=>$subtotal-(($subtotal* $cupon_discount)/100)
                                        ]);
                                    @endphp
                                    </ul>
                                    <a href="{{route('checkout')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection


@section('footer_scripts')
<script>

    $(document).ready(function(){
        $('#apply_cupon_btn').click(function(){
            var cupon_name =  $('#apply_cupon_input').val();
            var link_to_go = "{{url('cart')}}/" + cupon_name;
            // alert(link_to_go);
            window.location.href = link_to_go;
        });
    });

</script>
@endsection