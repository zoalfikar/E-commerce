@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>complaints list</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped" style="table-layout: auto;">
            <tr>
                <th >user name</th>
                <th>product name</th>
                <th >complaint text</th>
            </tr>


          @foreach ($complaints as $complaint)
              <tr>
                  <td >{{$complaint->user->name}}</td>
                  <td >{{$complaint->product->name}}</td>
                  <td style="white-space: nowrap;">{{$complaint->complain}}</td>
              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
