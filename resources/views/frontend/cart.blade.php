@extends('layouts.frontend')

@section('title')

    my cart

@endsection



@section('content')
    <div class="container ">
        <a href="{{url('/')}}">home</a> /
        <a href="#"> cart</a>
        <a class="btn btn-primary float-end" href="{{url()->previous()}}">back</a>
    </div>

    <div class="container card-reload my-5">
        @if (count($cartIteams)>0)
            <div class="card shadow ">
                <div class="card-body">
                    @php $total=0;    @endphp
                    @foreach ($cartIteams as $item)

                        <div class="row  product_data">
                            <div class="col-md-2">
                                <img src="{{asset('assets/uploads/product/'.$item->product->img)}}" alt="NOT FOUND " style="height: 70px; width:70px">
                            </div>
                            <div class="col-md-5">
                               <a href="/productDetails/{{$item->product->Category->slug}}/{{$item->product->slug}}"> <h6>{{$item->product->name}}</h6></a>
                            </div>
                            <div class="col-md-3">
                                <div class="input-groub text-center mb-3" style="width: 130px">
                                    <input type="hidden" class="prod_id" value="{{$item->prod_id}}">
                                    <label for="">quantity</label>
                                    <button style="width: 10px" class=" change-value decrement-btn form-control ">-</button>
                                    <input type="text" name="quantity" style="width: 10px" class="form-control qty-input text-center" value="{{$item->prod_qty}}">
                                    <button style="width: 10px" class="change-value increment-btn form-control ">+</button>
                                    @if ($item->product->qty >= $item->prod_qty)
                                    @php $total+=(float)$item->product->selling_price*$item->prod_qty; @endphp
                                    @else
                                    <h4>out of stuck</h4>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger delet-cart-item"><i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>total price &nbsp; {{$total}}$</h6>
                    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">check out</a>
                </div>
            </div>
        @else
            <div class="card text-center">
                <h2>your <i class="fa fa-shopping-cart"></i> card is empty</h2>
                <div class="card-foter">
                    <a href="{{url('showCategories')}} " class="btn btn-outline-primary float-end">continue to shoping</a>
                </div>
            </div

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

            function loadCart()
            {
                $.ajax(
                    {
                        method: "get",
                        url:"/get-cart-count",
                        success:function(response)
                        {
                            if (response.status>0)
                            {
                                $('.cat-items-count').html( response.status);
                            } else
                            {
                                $('.cat-items-count').html('');
                            }
                        }

                    });
            }


            $(".increment-btn").click(function()
                {
                    var inc_value=$(this).closest('.product_data').find('.qty-input').val();
                    var value=parseInt(inc_value,10);
                    value= isNaN(value) ? 0 : value ;
                    if (value<10)
                        {
                            value++;
                            $(this).closest('.product_data').find('.qty-input').val(value);

                        }
                });

                $(".decrement-btn").click(function()
                {

                    var dec_value=$(this).closest('.product_data').find('.qty-input').val();
                    var value=parseInt(dec_value,10);
                    value= isNaN(value) ? 0 : value ;
                    if (value>0)
                        {
                            value--;
                            $(this).closest('.product_data').find('.qty-input').val(value);

                        }
                });



                $(document).on('click','.delet-cart-item' ,function (e)

                {
                    e.preventDefault();
                    var value=$(this).closest('.product_data').find('.prod_id').val();
                    $.ajax(
                        {
                            method: "POST",
                            url:"/delet-from-cart",
                            data:{
                            'prod_id':value,
                            },

                            success:function(response)
                            {
                                //window.location.reload();
                                loadCart();
                                $(".card-reload").load(location.href+" .card-reload");
                                swal("",response.status,"success");
                            }

                        });
                });

                $('.change-value').click(function(){
                    var v_prod=$(this).closest('.product_data').find('.prod_id').val();
                    var v_qty=$(this).closest('.product_data').find('.qty-input').val();
                    $.ajax(
                    {
                        method: "POST",
                           url:"/update-cart",
                           data:{
                            'prod_id':v_prod,
                            'qty':v_qty
                           },
                           success:function(response){
                               window.location.reload();
                           }
                    });
                });
        });


</script>


@endsection
