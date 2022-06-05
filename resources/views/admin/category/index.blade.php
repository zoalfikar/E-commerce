@extends('layouts.admin')
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$item->slug}}">
                        Translett <span><i class="fa fa-star"></i></span>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="{{$item->slug}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @php $langs=selectLan()  @endphp
                                    @foreach ($langs as $lang)
                                        <a  href="translet-category/{{$item->id}}/{{$lang->abbe}}" class="btn">{{$lang->name}}</a><br>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                    <a  href="edit-category/{{$item->id}}" class="btn">Edite</a>
                    <a  href="delete-category/{{$item->id}}" class="btn">Delete</a>

                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
