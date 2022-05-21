@extends('layouts.frontend')

@section('title')

    categories

@endsection



@section('content')

    @include('layouts/inct/frontendslider')

    <div class="container ">
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
                                <img src="{{asset('assets/uploads/categoy/'.$categoy->img)}}" alt="not found">
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




