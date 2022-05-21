@extends('layouts.frontend')

@section('title')

    welcom page

@endsection



@section('content')

    @include('layouts/inct/frontendslider')

    <div class="py-5">
        <div class="container">
            <h1>Featured Products</h1>
            <div class="row">
                <div class="owl-carousel my-carousel owl-theme">
                    @foreach ($products as $product)
                        <div class="item">
                            <div class="card">
                                <a href="{{url('/productDetails/'.$product->category->slug.'/'.$product->slug)}}">
                                    <img src="{{asset('assets/uploads/product/'.$product->img)}}" alt="not found">
                                    <div class="card-body">
                                        <h4>{{$product->name}}</h4>
                                        <p class="float-start">{{$product->selling_price}}</p>
                                        <p class="float-end"><s>{{$product->orginal_price}}</s></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="py-5">
        <div class="container">
            <h1>Trendin Categories</h1>
            <div class="row">
                <div class="owl-carousel my-carousel owl-theme">
                    @foreach ($categories as $category)
                        <div class="item">
                            <div class="card">
                                <a href="{{url('/productsOfCateg/'.$category->slug)}}">
                                    <img src="{{asset('assets/uploads/category/'.$category->img)}}" alt="not found">
                                    <div class="card-body">
                                        <h4>{{$category->name}}</h4>
                                        <p class="float-start">{{$category->description}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection



@section('scripts')

    <script>
        $('.my-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>

@endsection
