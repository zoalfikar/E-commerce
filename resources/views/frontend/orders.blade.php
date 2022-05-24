@extends('layouts.frontend')

@section('title')

    my orders

@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <th>first name</th>
                        <th>lasr name</th>
                        <th>status</th>
                        <th>total price</th>
                        <th>tracking number</th>
                        <th>action</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->fname}}</td>
                                <td>{{$order->lname}}</td>
                                <td>{{$order->state == 0 ?'binding':'done' }}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->tracking_no}}</td>
                                <td><a href="{{url('/order-details/'.$order->id)}}" class="btn btn-primary">view</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

