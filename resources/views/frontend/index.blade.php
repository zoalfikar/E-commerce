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

   <center> 
        <div class="containar">
            <div class="posts">



            </div>
        </div>
    </center>

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
                $('.posts').append(" <div class=\"container\"><h1>"+message.data.name+"</h1>"
                    +"<h1>"+message.data.storName+"</h1>"
                    +"</div>"
                );
            });
        });
    </script>
@endsection
<div class="card-body ">
    <h3 class="card-title">{{$product->name}}</h3>
    <h6 class="card-subtitle">{{$product->small_description}}</h6>
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="white-box text-center"><img src="{{asset('assets/uploads/product/'.$product->img)}}" class="img-responsive" style="width:430px; height:430px"></div>
        </div>
        <div style="position: relative; padding-left:1cm"  class="col-lg-7 col-md-6 col-sm-6 ">
            <h4 class="box-title mt-2">description</h4>
            <p>{{$product->description}}</p>
            <h2 class="mt-5">
                <small class="text-success"><s>{{$product->orginal_price}}</s></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <small class="text-success ">{{$product->selling_price}}</small>
            </h2>
            <input type="hidden" value="{{$product->id}}" class="prod_id">
            @if ($product->qty>0)
                <button class="  mt-4 addToCartBtn btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                    <i class="fa fa-shopping-cart"></i> add to cart
                </button>
             @endif
            <button class=" mt-4 btn btn-primary btn-rounded addToWishlis">
                <i class="fa fa-heart"></i>add to wishlist
            </button>
            <div class="input-groub text-center mb-3" style="width: 130px">
               <label>quantity</label>
               <button style="width: 10px" class=" decrement-btn form-control ">-</button>
               <input type="text" name="quantity" style="width: 10px" class="form-control qty-input text-center" value="1">
               <button style="width: 10px" class=" increment-btn form-control ">+</button>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-6 mt-3 content-center">

            <h5>rating</h4>
            <span style="color: rgb(109, 0, 182)" >{{$numberOfRatings}}</span>&nbsp; people have rated this product
            <br>
            @for ($i = 0; $i < $pruduct_rate_value; $i++)
                <i  style="color: yellow" class="fa fa-star"></i>
            @endfor
            @for ($l = 0; $l <5-$pruduct_rate_value; $l++)
                <i class="fa fa-star"></i>
            @endfor
            <br>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                rate this product <span><i class="fa fa-star"></i></span>
            </button>
            <br>
            <a href="{{url('add-reviw/'.$product->slug.'/user-review')}}" class="btn btn-primary">add review</a>
            <a href="{{url('add-complain/'.$product->id)}}" class="btn btn-danger">
                File a complaint
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3 class="box-title mt-5">General Info</h3>
            <div class="table-responsive">
                <table class="table table-striped table-product">
                    <tbody>
                        <tr>
                            <td width="390">tax</td>
                            <td>{{$product->tax}}</td>
                        </tr>
                        <tr>
                            <td width="390">aviliable</td>

                            @if ($product->qty>0)
                                <td>instock</td>
                            @else
                                <td class="badge bg-danger">out of stock</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>