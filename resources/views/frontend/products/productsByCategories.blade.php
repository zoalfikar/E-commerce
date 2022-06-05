@extends('layouts.frontend')

@section('title')

    products

@endsection



@section('content')
    @include('layouts/inct/frontendslider')
    <div  style="background-color: bisque">
       <a href="{{url('/showCategories')}}">collection</a> / <a href="{{url('/productsOfCateg/'.$category->slug)}}">{{$category->name}}</a>
    </div>

    <div class="py-5">
        <div class="container">
            <h1>{{$category->name}}</h1>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mt-3">
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
                                <button id="activeBtn" class="btn btn-primary" value="{{$product->id}}">active</button>
                            @else
                                <button id="preventBtn" class="btn btn-danger" value="{{$product->id}}">prevent</button>
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
                $('#activeBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.card').find('#activeBtn').val();
                    $.ajax(
                    {
                        method: "post",
                        url: "active-product",
                        data:
                        {
                            "prod_id":value,
                        },
                        success: function (response)
                        {
                            $(".row").load(location.href+" .row");
                        }
                    });

                });

                $('#preventBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.card').find('#preventBtn').val();
                    $.ajax(
                    {
                        method: "post",
                        url: "prevent-product",
                        data:
                        {
                            "prod_id":value,
                        },
                        success: function (response)
                        {
                            $(".row").load(location.href+" .row");
                        }
                    });

                });
            });

        </script>

@endsection




