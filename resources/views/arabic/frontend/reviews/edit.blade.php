@extends('layouts.frontend')

@section('title')

    تعديل مراجعك

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @if ( $verify_purchase->count( ) > 0)
                            <h3>اكتب مراجعة مفيدة عن  {{$prod_chek->name}}</h3>
                            <form action="{{url('add-reviw')}}" method="post">
                                @csrf
                                <input type="hidden" name="prod_id" value=" {{$prod_chek->id}}">
                                <textarea class="form-control" name="user_review"  cols="30" rows="5">{{$review->user_review}}</textarea>
                                <button class="btn btn-primary" type="submit">ارسل هذه المراجعة</button>
                            </form>

                        @else
                            <div class="alert alert-danger">
                                <h2>لاتستطيع اضافة مراجعة لهذا المنتج</h2>
                            </div>
                            <p>
                                فقط الزبائن الذين اشترو هذاالمنتج يمكنهم اضافة مراجعة
                            </p>
                            <a href="{{url('/')}}">العودة للرئيسية</a>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
