@extends('layouts.frontend')

@section('title')

    add complain

@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h4> add compliant about {{$product->name}} </h4>
            <form action="{{url('/complain')}}" method="post">
                @csrf
                <input type="hidden" name="prod_id" value="{{$product->id}}">
                <textarea class="form-control" name="complain" id="" cols="10" rows="8"  placeholder="write your complain aboute this product"></textarea>
                <input type="submit" class="form-control btn btn-danger w-30 " value="send your complain" >
            </form>
        </div>
        @foreach ($errors->all() as $reorr)
            <span  style="position:relative; padding-left:1cm " role="alert">
                <strong>{{ $reorr }}</strong>
            </span>
        @endforeach


    </div>
</div>

@endsection
