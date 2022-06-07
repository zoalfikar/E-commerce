@extends('layouts.frontend')

@section('title')

    categories

@endsection



@section('content')

    @include('layouts/inct/frontendslider')

    <div style="background-color: bisque; height:50px">
        <a href="{{url('/showCategories')}}">collection</a>
     </div>

    <div class="py-5">
        <div class="container category_reload">
            <h1>All Categories</h1>
            <div class="row ">
                @foreach ($categories as $categoy)
                    <div class="col-md-3 mt-3" >
                        <div class="card category ">
                            <a href="{{url('/productsOfCateg/'.$categoy->slug)}}">
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
                    var value=$(this).closest('.category').find('.activeBtn').val();
                    $.ajax(
                    {
                        method: "post",
                        url: "active-category",
                        data:
                        {
                            "cat_id":value,
                        },
                        success: function (response)
                        {
                            $(".category_reload").load(location.href+" .category_reload");
                        }

                    });

                });

                $('.preventBtn').click(function (e) {
                    e.preventDefault();
                    var value=$(this).closest('.category').find('.preventBtn').val();
                    $.ajax(
                    {
                        method: "post",
                        url: "prevent-category",
                        data:
                        {
                            "cat_id":value,
                        },
                        success: function (response)
                        {
                            $(".category_reload").load(location.href+" .category_reload");
                        }
                    });

                });
            });

        </script>

@endsection





