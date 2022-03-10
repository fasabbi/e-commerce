@extends('layouts.honey')

@section('body')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shop Page</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
<!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($categories as $iii)
                            <li>
                                <a data-toggle="tab" href="#{{$iii->id}}">{{$iii->category_name}}</a>
                            </li>
                            @endforeach
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($all_product as $ff)
                                         @include('parts.little')
                        @endforeach
                            
                    </ul>
                </div>
                @foreach ($categories as $iii)
                <div class="tab-pane" id="#{{$iii->id}}">
                    <ul class="row">
                        @foreach (App\Models\Product::where('category_id',$iii->id)->get() as $ff)
                                         @include('parts.little')
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- product-area end -->
@endsection