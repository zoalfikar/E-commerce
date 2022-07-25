@extends('layouts.userControllPanel')
@section('content')

<div class="card">
    <div class="card-header">
         <h1>Categories</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">Name</th>
                <th class=" w-30">description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>


          @foreach ($categories as $item)
              <tr>
                  <td >{{$item->name}}</td>
                  <td >{{$item->description}}</td>
                  <td> <img class="w-25" src="{{asset('assets/uploads/category/'.$item->img)}}" alt="not found"> </td>
                  <td>
                    <a  href="store-edit-category/{{$item->id}}" class="btn">Edite</a>
                    <a  href="delete-category/{{$item->id}}" class="btn">Delete</a>

                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
