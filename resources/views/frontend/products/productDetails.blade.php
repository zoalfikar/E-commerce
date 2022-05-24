@extends('layouts.frontend')

@section('title',$product->name)






@section('content')

    @include('layouts/inct/frontendslider')

    <div style="background-color: bisque" class="container ">
        <a href="{{url('/showCategories')}}">collection</a>/
        <a href="{{url('/productsOfCateg/'.$product->category->slug)}}">{{$product->category->name}}</a>/
        <a href="{{url('/productDetails/'.$product->category->slug.'/'.$product->slug)}}">{{$product->name}}</a>
     </div>

    <div class="container mt-5">
        <div class="card product_data">
            <div class="card-body ">
                <h3 class="card-title">{{$product->name}}</h3>
                <h6 class="card-subtitle">{{$product->small_description}}</h6>
                @if ($product->trending==1)
                    <label style="font-size: 16px" class="float-end ">trending</label>
                @endif
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center"><img src="{{asset('assets/uploads/product/'.$product->img)}}" class="img-responsive" style="width:430px; height:430px"></div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h4 class="box-title mt-5">description</h4>
                        <p>{{$product->description}}</p>
                        <h2 class="mt-5">
                            <small class="text-success"><s>{{$product->orginal_price}}</s></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <small class="text-success ">{{$product->selling_price}}</small>
                        </h2>
                        <input type="hidden" value="{{$product->id}}" class="prod_id">
                        @if ($product->qty>0)
                            <button class=" addToCartBtn btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                                <i class="fa fa-shopping-cart"></i> add to cart
                            </button>
                         @endif
                        <button class="btn btn-primary btn-rounded">Buy Now</button>
                        <div class="input-groub text-center mb-3" style="width: 130px">
                           <label>quantity</label>
                           <button style="width: 10px" class=" decrement-btn form-control ">-</button>
                           <input type="text" name="quantity" style="width: 10px" class="form-control qty-input text-center" value="1">
                           <button style="width: 10px" class=" increment-btn form-control ">+</button>
                        </div>
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

            });


    </script>

@endsection




