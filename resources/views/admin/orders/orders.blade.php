@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>orders list</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">order date</th>
                <th class=" w-30">tracking number</th>
                <th>status</th>
                <th>Action</th>
            </tr>


          @foreach ($orders as $item)
              <tr>
                  <td >{{$item->created_at}}</td>
                  <td >{{$item->tracking_no}}</td>
                  <td> {{$item->status == 0 ?'binding':'done' }}</td>
                  <td>
                    <a   href="d-order-details/{{$item->id}}" class="btn btn-primary">view</a>
                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
