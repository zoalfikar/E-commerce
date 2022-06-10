@extends('layouts.frontend')

@section('title')

    products

@endsection



@section('content')
    @include('layouts/inct/frontendslider')
    <div  style="background-color: bisque; height:50px ">
       <a href="{{url('/showCategories')}}">collection</a> / <a href="{{url('/productsOfCateg/'.$category->slug)}}">{{$category->name}}</a>
    </div>

    <div class="py-5">
        <div class="container reload">
            <h1>{{$category->name}}</h1>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mt-3 product_data">
                        <a href="{{url('/productDetails/'.$category->slug.'/'.$product->slug)}}">
                            <div class="card">
                                <img  style="height: 320px; width:270px" src="{{asset('assets/uploads/product/'.$product->img)}}" alt="not found">
                                <div class="card-body">
                                    <h4>{{$product->name}}</h4>
                                    <p class="float-start">{{$product->description}}</p>
                                </div>
                            </div>
                        </a>
                      @if (isAdmin())
                            @if ($product->status=='1')
                                <button  class="btn btn-primary activeBtn" value="{{$product->id}}">active</button>
                            @else
                                <button  class="btn btn-danger preventBtn" value="{{$product->id}}">prevent</button>
                            @endif
                        @endif
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
                $('.activeBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.product_data').find('.activeBtn').val();
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
                            //$(".reload").load(location.href+" .reload");
                        }
                    });

                });

                $('.preventBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.product_data').find('.preventBtn').val();
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
                            //$(".reload").load(location.href+" .reload");
                        }
                    });
                });
            });

        </script>

@endsection




