@extends('layouts.frontend')

@section('title')

    stores

@endsection



@section('content')

    @include('layouts/inct/frontendslider')

    <div class="py-5">
        <div class="container">
            @if (!userHasStore())
                <a href="{{url('/new-store')}}" class="btn btn-secondary btn-lg btn-block "><h6>create your store + </h6></a>
            @endif
           <h1>All Stores</h1>
           <div class="row ">
               @foreach ($stores as $store)
                   <div class="col-md-3 mt-3" >
                       <div class="card category ">
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

@endsection



@section('scripts')

    <script>




    </script>

@endsection
