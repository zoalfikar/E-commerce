@extends('frontend.stores.SFrontend.storeDetails')
@section('store-content')
        <div class="py-5">
            <div class="container reload">
               <center><h1>{{$category->name}}</h1></center>
                <div class="row">
                    @foreach ($category->products as $product)
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
