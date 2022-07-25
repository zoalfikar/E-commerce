@extends('frontend.stores.SFrontend.storeDetails')
@section('store-content')
<div class="py-5">
    <div class="container category_reload">
       <center><h1>All Categories</h1></center>
        <div class="row ">
            @foreach ($store->categories as $categoy)
                <div class="col-md-4 mt-3" >
                    <div class="card category ">
                        <a href="{{url('/store-productsOfCateg/'.$store->slug.'/'.$categoy->slug)}}">
                            <img  style="height: 320px; width:270px" src="{{asset('assets/uploads/category/'.$categoy->img)}}" alt="not found">
                            <div class="card-body">
                                <h4>{{$categoy->name}}</h4>
                                <p class="float-start">{{$categoy->description}}</p>
                            </div>
                        </a>
                        <div>
                            @if (isAdmin())
                                @if ($categoy->status=='1')
                                    <button  class="btn btn-primary activeBtn" value="{{$categoy->id}}">active</button>
                                @else
                                    <button  class="btn btn-danger preventBtn" value="{{$categoy->id}}">prevent</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

