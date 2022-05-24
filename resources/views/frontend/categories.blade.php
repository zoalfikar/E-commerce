@extends('layouts.frontend')

@section('title')

    categories

@endsection



@section('content')

    @include('layouts/inct/frontendslider')

    <div style="background-color: bisque" class="container ">
        <a href="{{url('/showCategories')}}">collection</a>
     </div>

    <div class="py-5">
        <div class="container">
            <h1>All Categories</h1>
            <div class="row">
                @foreach ($categories as $categoy)
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <a href="{{url('/productsOfCateg/'.$categoy->slug)}}">
                                <img  style="height: 320px; width:270px" src="{{asset('assets/uploads/category/'.$categoy->img)}}" alt="not found">
                                <div class="card-body">
                                    <h4>{{$categoy->name}}</h4>
                                    <p class="float-start">{{$categoy->description}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection




