





@extends('layouts.frontend')

@section('title')

    order details

@endsection

@section('content')

    <div class="container">
        <div class="row">

            <a style="background-color: rgb(207, 207, 250)" href="{{url('/orders')}}" class="btn btn-pimary float-end">back</a>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="">first name:</label>
                                {{Auth::user()->name}}
                            </div>
                            <div class="col-md-6">
                                <label for="">last name: </label>
                                {{Auth::user()->last_name}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">email:</label>
                                {{Auth::user()->email}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">phone number:</label>
                                {{Auth::user()->phone_number}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">address 1:</label>
                                {{Auth::user()->address1}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">address 2:</label>
                                {{Auth::user()->address2}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">city:</label>
                                {{Auth::user()->city}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">state:</label>
                                {{Auth::user()->state}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">country:</label>
                                {{Auth::user()->country}}
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">pin cod:</label>
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
                                <th>name</th>
                                <th>prod_qty</th>
                                <th>price</th>
                                <th>picture</th>
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
                </div>
            </div>
        </div>
    </div>

@endsection












