





@extends('layouts.frontend')

@section('title')

    تفاصيل الطلب

@endsection

@section('content')

    <div class="container">
        <div class="row">

            <a style="background-color: rgb(207, 207, 250)" href="{{url('/orders')}}" class="btn btn-pimary float-end">عودة</a>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label style="" for="">الاسم الاول:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->name}}
                            </div>
                            <div class="col-md-6">
                                <label for="">الاسم الاخير: </label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->last_name}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">الايميل:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->email}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">رقم الهاتف:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->phone_number}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">العنوان الاول:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->address1}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">العنوان الثاني:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->address2}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">المدينة:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->city}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">الولاية:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->state}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">البلد:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->country}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">رمزال pin:</label>&nbsp;&nbsp;&nbsp;
                                {{Auth::user()->pin_code}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <th>اسم المنتج</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>صورة المنتج</th>
                            </thead>
                            <tbody>
                                @foreach ($orders->OrderItems as $item )
                                    <tr>
                                        <td>{{$item->pruduct->name}}</td>
                                        <td>{{$item->prod_qty}}</td>
                                        <td>{{$item->price}}</td>
                                        <td><img style="height:30px; width:30px" src="{{asset('assets/uploads/product/'.$item->pruduct->img)}}" alt="not found"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <h4>السعر الكلي :{{$orders->total_price}}$</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection












