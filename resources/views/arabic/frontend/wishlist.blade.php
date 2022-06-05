@extends('layouts.frontend')

@section('title')

    السلة

@endsection



@section('content')
    <div class="container ">
        <a href="{{url('/')}}">الرئيسية</a> /
        <a href="#"> السلة</a>
        <a class="btn btn-primary float-start" href="{{url()->previous()}}">عودة</a>
    </div >
    <div class="container my-5">
        @if (count($prods)>0)
            <div class="card shadow  ">
                <div class="card-body">
                    @foreach ($prods as $item)
                        <div class="row product_data ">
                            <input type="hidden" value="{{$item->Product->id}}" class="prod_id">
                            <div class="col-md-2">
                                <img src="{{asset('assets/uploads/product/'.$item->product->img)}}" alt="NOT FOUND " style="height: 70px; width:70px">
                            </div>
                            <div class="col-md-3">
                               <a href="/productDetails/{{$item->product->Category->slug}}/{{$item->product->slug}}"> <h6>{{$item->product->name}}</h6></a>
                            </div>
                            <div class="col-md-2">
                                    @if ($item->product->qty > 0)
                                    <h4>متوفرة</h4>
                                    @else
                                    <h4>خارج الكمية</h4>
                                    @endif
                            </div>
                            <div class="col-md-3">
                                @if ($item->product->qty > 0)
                                <button class="btn btn-primary btn-rounded addTocart">
                                    <i class="fa fa-heart"></i>اضف الى الكرت
                                </button>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger delet-wishlist-item"><i class="fa fa-trash"></i> ازالة</button>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        @else
            <div class="card text-center">
                <h2>your <i class="fa fa-shopping-cart"></i> السلة فارغة</h2>
                <div class="card-footer">
                    <a href="{{url('showCategories')}} " class="btn btn-outline-primary float-end">اذهب للتسوق</a>
                </div>
            </div>
        @endif
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


            $(".addTocart").click(function()
                    {
                       var product_id =$(this).closest('.product_data').find('.prod_id').val();
                       var product_qty =$(this).closest('.product_data').find('.qty-input').val();
                       $.ajax(
                        {
                           method: "post",
                           url:"/add-to-cart",
                           data:{
                            'product_id':product_id,
                            'product_qty':1
                           },

                           success:function(response){
                               window.location.reload();
                               alert(response.status);
                           }


                        });
                    });

                $(".delet-wishlist-item").click(function()
                {
                    var value=$(this).closest('.product_data').find('.prod_id').val();
                    $.ajax(
                        {
                           method: "POST",
                           url:"/delet-from-wishlist",
                           data:{
                            'prod_id':value,
                           },

                           success:function(response){
                               window.location.reload();
                               swal("",response.status,"success");
                           }

                        });
                });

        });


</script>


@endsection
