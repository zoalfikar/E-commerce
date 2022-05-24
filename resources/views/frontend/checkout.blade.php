@extends('layouts.frontend')

@section('title')

    checkout

@endsection



@section('content')

    <div class="container ">
        <a href="{{url('/')}}">home</a> /
        <a href="#"> checkout</a>
    </div>

    <div class="container mt-5">
        <form action="{{url('/placeholder')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">first name</label>
                                    <input type="text" value="{{Auth::user()->name}}" name="firstname" class="form-control" placeholder="enter your first name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">last name </label>
                                    <input type="text" value="{{Auth::user()->last_name}}" name="lastname" class="form-control" placeholder="ener your lastname">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">email</label>
                                    <input type="text" value="{{Auth::user()->email}}" name="email" class="form-control" placeholder="enter your email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">phone number</label>
                                    <input type="text" value="{{Auth::user()->phone_number}}" name="phonenumber" class="form-control" placeholder="enter your phon number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">address 1</label>
                                    <input type="text" value="{{Auth::user()->address1}}" name="address1" class="form-control" placeholder="enter your address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">address 2</label>
                                    <input type="text" value="{{Auth::user()->address2}}" name="address2" class="form-control" placeholder="enter your address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">city</label>
                                    <input type="text" value="{{Auth::user()->city}}" name="city" class="form-control" placeholder="enter your city">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">state</label>
                                    <input type="text" value="{{Auth::user()->state}}" name="state" class="form-control" placeholder="enter your state">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">country</label>
                                    <input type="text" value="{{Auth::user()->country}}" name="country" class="form-control" placeholder=" enter your country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">pin cod</label>
                                    <input type="text" value="{{Auth::user()->pin_code}}" name="pincod" class="form-control" placeholder="enter your pin code">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Deyails</h6>
                            <hr>
                            <table class="table table-striped table-bordered" >
                                <thead>
                                    <td>Name</td>
                                    <td>quantity</td>
                                    <td>pric</td>
                                </thead>
                                <tbody>
                                    @foreach ($iteamCard as $item)
                                        <tr>
                                            <td>{{$item->product->name}}</td>
                                            <td>{{$item->prod_qty}}</td>
                                            <td>{{$item->product->selling_price}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary float-end">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
