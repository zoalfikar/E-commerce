@extends('layouts.frontend')

@section('title')

    add reviw

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @if ( $verify_purchase->count( ) > 0)
                            <h3>you are writing review for {{$prod_chek->name}}</h3>
                            <form action="{{url('add-reviw')}}" method="post">
                                @csrf
                                <input type="hidden" name="prod_id" value=" {{$prod_chek->id}}">
                                <textarea class="form-control" name="user_review"  cols="30" rows="5">{{$review->user_review}}</textarea>
                                <button class="btn btn-primary" type="submit">send your review</button>
                            </form>

                        @else
                            <div class="alert alert-danger">
                                <h2>you can not review this product</h2>
                            </div>
                            <p>
                                only customers who purchased this product can write review
                            </p>
                            <a href="{{url('/')}}">go to home page</a>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
