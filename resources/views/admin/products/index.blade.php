@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>Products</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">category</th>
                <th class=" w-10">Name</th>
                <th class=" w-30">selling</th>
                <th>Image</th>
                <th>Action</th>
            </tr>


          @foreach ($Products as $item)
              <tr>
                  <td>{{$item->Category->name}}</td>
                  <td >{{$item->name}}</td>
                  <td >{{$item->selling_price}}</td>
                  <td> <img class="w-25" src="{{asset('assets/uploads/Product/'.$item->img)}}" alt="not found"> </td>
                  <td>
                    <a  href="edit-product/{{$item->id}}" class="btn">Edite</a>
                    <a  href="delete-product/{{$item->id}}" class="btn">Delete</a>

                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
