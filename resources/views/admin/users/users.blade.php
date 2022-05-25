@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>users list</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">User Name</th>
                <th class=" w-30">Email</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>


          @foreach ($users as $user)
              <tr>
                  <td >{{$user->name}}</td>
                  <td >{{$user->email}}</td>
                  <td> {{$user->phone_number}}</td>
                  <td>
                    <a   href="user-detail/{{$user->id}}" class="btn btn-primary">view</a>
                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
