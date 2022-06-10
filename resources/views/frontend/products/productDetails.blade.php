@extends('layouts.frontend')

@section('title',$product->name)






@section('content')

    @include('layouts/inct/frontendslider')
    @php    $pruduct_rate_value= number_format($pruduct_rate)   @endphp
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rate-form" action="{{url('rate-product')}}" method="post">
                        @csrf
                        @if ($user_Rating)
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="hidden" name="prod-id" value="{{$product->id}}">
                                @for ($i = 1; $i <= $user_Rating->rate_value; $i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                @for ($l = $user_Rating->rate_value+1; $l <=5; $l++)
                                    <input type="radio" value="{{$l}}" name="product_rating" id="rating{{$l}}">
                                    <label for="rating{{$l}}" class="fa fa-star"></label>
                                @endfor
                            </div>
                        </div>

                        @else
                        <input type="hidden" name="prod-id" value="{{$product->id}}">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="rate-form">rate now</button>
                </div>
            </div>
        </div>
    </div>



    <div style="background-color: bisque; height:50px">
        <a href="{{url('/showCategories')}}">collection</a>/
        <a href="{{url('/productsOfCateg/'.$product->category->slug)}}">{{$product->category->name}}</a>/
        <a href="{{url('/productDetails/'.$product->category->slug.'/'.$product->slug)}}">{{$product->name}}</a>
     </div>

    <div class="container mt-5 reload">
        <div class="card product_data">
            <div class="card-header">
                @if ($product->trending==1)
                    <label style="font-size: 16px; background-color:rgb(7, 211, 194)" class="float-end"> &nbsp; trending &nbsp; </label>
                @endif
                @if (isAdmin())
                    @if ($product->status=='1')
                        <button id="activeBtn" class="btn btn-primary" value="{{$product->id}}">active</button>
                    @else
                        <button id="preventBtn" class="btn btn-danger" value="{{$product->id}}">prevent</button>
                @endif
            @endif
            </div>
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
        <div class="card">
            <div class="card-header">
                <h2>reviews for this product</h2>
            </div>
            <div class="card-body">
                @foreach ($reviews as $review)

                <div class="row">
                    <div class="col mt-6">
                        <div class="card-subtitle"> {{$review->user->name}} &nbsp;&nbsp; {{$review->created_at}}</div>

                        @for ($i = 0; $i < $review->rating->rate_value; $i++)
                            <i  style="color: yellow" class="fa fa-star"></i>
                        @endfor

                        @for ($l = 0; $l <5-$review->rating->rate_value; $l++)
                            <i class="fa fa-star"></i>
                        @endfor

                        <p class="mt-3">{{$review->user_review}}</p>

                        @if ($review->user->id==Auth::id())
                                <a href= "{{url('edit-reviw/'.$product->slug.'/user-review')}}" class="btn btn-primary"> edit</a>
                        @endif

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>




@endsection

@section('scripts')
    <script>
        $(document).ready(function ()
            {
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });



                $(".addToCartBtn").click(function()
                    {
                       var product_id =$(this).closest('.product_data').find('.prod_id').val();
                       var product_qty =$(this).closest('.product_data').find('.qty-input').val();
                       $.ajax(
                        {
                           method: "post",
                           url:"/add-to-cart",
                           data:{
                            'product_id':product_id,
                            'product_qty':product_qty
                           },

                           success:function(response){
                               window.location.reload();
                               alert(response.status);

                           }
                        });
                    });

                    $(".addToWishlis").click(function()
                    {
                       var product_id =$(this).closest('.product_data').find('.prod_id').val();
                       $.ajax(
                        {
                           method: "post",
                           url:"/add-to-wishlist",
                           data:{
                            'product_id':product_id,
                           },

                           success:function(response){
                               alert(response.status);
                            }
                        });
                    });


                $(".increment-btn").click(function()
                    {
                        var inc_value=$(this).closest('.product_data').find('.qty-input').val();
                        var value=parseInt(inc_value,10);
                        value= isNaN(value) ? 0 : value ;
                        if (value<10)
                            {
                                value++;
                                $(this).closest('.product_data').find('.qty-input').val(value);

                            }
                    });

                    $(".decrement-btn").click(function()
                    {
                        var dec_value=$(this).closest('.product_data').find('.qty-input').val();
                        var value=parseInt(dec_value,10);
                        value= isNaN(value) ? 0 : value ;
                        if (value>0)
                            {
                                value--;
                                $(this).closest('.product_data').find('.qty-input').val(value);

                            }
                    });
                    $('#activeBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.product_data').find('#activeBtn').val();
                    $.ajax(
                    {
                        method: "post",
                        url: "/active-product",
                        data:
                        {
                            "prod_id":value,
                        },
                        success: function (response)
                        {
                            window.location.reload();
                        }
                    });

                });

                $('#preventBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.product_data').find('#preventBtn').val();
                    $.ajax(
                    {
                        method: "POST",
                        url: "/prevent-product",
                        data:
                        {
                            "prod_id":value,
                        },
                        success: function (response)
                        {
                            window.location.reload();
                        }
                    });
                });

            });


    </script>

@endsection




