@extends('layouts.admin')
@section('content')

<div class="container">
    <a style="background-color: rgb(207, 207, 250)" href="{{url('/order-list')}}" class="btn btn-pimary float-end">back</a>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <h3>order detail</h3>
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
                    <table class="table text-center table-striped">
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
                    <h4>Grand total :{{$orders->total_price}}</h4>
                    <div class="mt-3">
                        <form action= "/update-order/{{$orders->id}}" method="post">
                            @csrf
                            <select name="status" class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option {{$orders->status==0?'selected':''}}  value="0">pinding</option>
                                <option {{$orders->status==1?'selected':''}} value="1">done</option>
                            </select>
                            <hr>
                            <input class="btn btn-outline-primary" type="submit" value="update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
