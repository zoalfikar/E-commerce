@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
         <h1>المنتجات</h1>
    </div>
    <hr>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th class=" w-10">الفئة</th>
                <th class=" w-10">الاسم</th>
                <th class=" w-30">المبيع</th>
                <th>صورة المنتج</th>
                <th>عملية</th>
            </tr>


          @foreach ($Products as $item)
              <tr>
                  <td>{{$item->Category->name}}</td>
                  <td >{{$item->name}}</td>
                  <td >{{$item->selling_price}}</td>
                  <td> <img class="w-25" src="{{asset('assets/uploads/Product/'.$item->img)}}" alt="not found"> </td>
                  <td>
                    <a  href="edit-product/{{$item->id}}" class="btn">عدل</a>
                    <a  href="delete-product/{{$item->id}}" class="btn">احذف</a>

                  </td>

              </tr>
          @endforeach
        </table>
    </div>
</div>


@endsection
