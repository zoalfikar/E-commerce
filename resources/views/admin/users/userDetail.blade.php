@extends('layouts.admin')
@section('content')

<div class="container">
    <a style="background-color: rgb(207, 207, 250)" href="{{url('/users')}}" class="btn btn-pimary float-end">back</a>
    <h3>user detail</h3>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <label for="">first name:</label>
                            {{$user->name}}
                        </div>
                        <div class="col-md-6">
                            <label for="">last name: </label>
                            {{$user->last_name}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">email:</label>
                            {{$user->email}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">phone number:</label>
                            {{$user->phone_number}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">address 1:</label>
                            {{$user->address1}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">address 2:</label>
                            {{$user->address2}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">city:</label>
                            {{$user->city}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">state:</label>
                            {{$user->state}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">country:</label>
                            {{$user->country}}
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">pin cod:</label>
                            {{$user->pin_code}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
