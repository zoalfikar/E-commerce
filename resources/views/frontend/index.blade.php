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
                <div class="owl-carousel my-carousel owl-theme ">
                    @foreach ($products as $product)
                        <div class="item">
                            <div class="card">
                                <a href="{{url('/productDetails/'.$product->category->slug.'/'.$product->slug)}}">
                                    <img style="height: 320px; width:270px" src="{{asset('assets/uploads/product/'.$product->img)}}" alt="not found">
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
            <h1>Popular Categories</h1>
            <div class="row">
                <div class="owl-carousel my-carousel owl-theme">
                    @foreach ($categories as $category)
                        <div class="item">
                            <div class="card">
                                <a href="{{url('/productsOfCateg/'.$category->slug)}}">
                                    <img  style="height: 320px; width:270px" src="{{asset('assets/uploads/category/'.$category->img)}}" alt="not found">
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



    <div class="py-5">
        <div class="container">
            <h1>Popular Stores</h1>
            <div class="row">
                <div class="owl-carousel my-carousel owl-theme">
                    @foreach ($stores as $store)
                        <div class="item">
                            <div class="card">
                                <a href="{{url('/storeDetails/'.$store->slug)}}">
                                    <img  style="height: 320px; width:270px" src="{{asset('assets/uploads/stores/'.$store->img)}}" alt="not found">
                                    <div class="card-body">
                                        <h4>{{$store->name}}</h4>
                                        <p class="float-start">{{$store->description}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="containar">
        <div class="posts">



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

    <script>
        $(function(){
            let ip_adress = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_adress+ ':'+ socket_port);

            socket.on('sendToClinet',(message)=>
            {
                $('.posts').append(" <div class=\"card-body \"><h3 class=\"card-title\">"+message.data.name+"</h3><h6 class=\"card-subtitle\">"+message.data.storName+small_description"</h6><div class=\"row\"><div class=\"col-lg-5 col-md-6 col-sm-6\"><div class=\"white-box text-center\"><img src=\"{{asset('assets/uploads/product/"+message.data.img+")</div></div></div>");
            });
        });
    </script>
@endsection
