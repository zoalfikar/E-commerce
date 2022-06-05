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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$item->slug}}">
                            Translett <span><i class="fa fa-star"></i></span>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="{{$item->slug}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Rating</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php $langs=selectLan()  @endphp
                                        @foreach ($langs as $lang)
                                            <a  href="translet-product/{{$item->id}}/{{$lang->abbe}}" class="btn">{{$lang->name}}</a><br>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            </div>
                        <a  href="edit-product/{{$item->id}}" class="btn">Edite</a>
                        <a  href="delete-product/{{$item->id}}" class="btn">Delete</a>

                    </td>
                </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
