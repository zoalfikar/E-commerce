@extends('layouts.frontend')

@section('title')

    products

@endsection



@section('content')
    @include('layouts/inct/frontendslider')
    <div  style="background-color: bisque" class="container  ">
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection




