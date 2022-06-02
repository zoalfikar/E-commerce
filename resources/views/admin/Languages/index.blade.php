@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>languages</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">abbe</th>
                <th class=" w-20">name</th>
                <th class=" w-20">locale</th>
                <th class=" w-10">direction</th>
                <th class=" w-20">status</th>
                <th>Action</th>
            </tr>


          @foreach ($lang as $language)
              <tr>
                  <td>{{$language->abbe}}</td>
                  <td >{{$language->name}}</td>
                  <td >{{$language->locale}}</td>
                  <td> {{$language->direction}}</td>
                  <td> {{$language->active}}</td>
                  <td>
                    <a  href="/edit-language/{{$language->id}}" class="btn">Edite</a>
                    <a  href="/delet-language/{{$language->id}}" class="btn btn-danger">Delete</a>
                  </td>
              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection

