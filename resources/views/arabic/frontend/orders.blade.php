@extends('layouts.frontend')

@section('title')

    طلباتي

@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <th>الاسم الاول</th>
                        <th>الاسم الاخير</th>
                        <th>حالة الطلب</th>
                        <th>السعر الاجمالي</th>
                        <th>رقم العملية</th>
                        <th>عملية</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->fname}}</td>
                                <td>{{$order->lname}}</td>
                                <td>{{$order->state == 0 ?'binding':'done' }}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->tracking_no}}</td>
                                <td><a href="{{url('/order-details/'.$order->id)}}" class="btn btn-primary">التفاصيل</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

