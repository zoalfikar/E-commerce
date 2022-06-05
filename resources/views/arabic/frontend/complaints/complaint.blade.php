@extends('layouts.frontend')

@section('title')

    اضافة شكاوى

@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h4> تقديم شكوى عن {{$product->name}} </h4>
            <form action="{{url('/complain')}}" method="post">
                @csrf
                <input type="hidden" name="prod_id" value="{{$product->id}}">
                <textarea class="form-control" name="complain" id="" cols="10" rows="8"  placeholder="   اكتب هنا شكواك عن المنتج على ان لاتزيد الرسالة عن 100 حرف  "></textarea>
                <input type="submit" class="form-control btn btn-danger w-30 " value="ارسل الشكوى" >
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
