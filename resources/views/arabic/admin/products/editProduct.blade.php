@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>Edit Product</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/edit-product/'.$product->id)}}" method="post" enctype="multipart/form-data" >

                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3 ">
                        <select name="cat_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected>{{$product->Category->name}}</option>
                          </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name">الاسم</label>
                        <input value="{{$product->name}}" type="text" class="form-control" name="name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">كلمة مفتاحية</label>
                        <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="small_description">وصف قصير</label>
                        <textarea name="small_description"  class="form-control"  style="resize: none;">{{$product->small_description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">الوصف</label>
                        <textarea name="description"  class="form-control"  style="resize: none;">{{$product->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="orginal_price">السعر الاصلي</label>
                        <input type="text" class="form-control" name="orginal_price" value="{{$product->orginal_price}}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">السعر المطلوب</label>
                        <input type="text" class="form-control" name="selling_price" value="{{$product->selling_price}}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty"> الكمية </label>
                        <input type="text" class="form-control" name="qty" value="{{$product->qty}}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tax"> ضريبة </label>
                        <input type="text" class="form-control" name="tax" value="{{$product->tax}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">الحالة</label>
                        <input type="checkbox"  name="status" {{ $product->status== "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">شائع</label>
                        <input type="checkbox"  name="trending"  {{ $product->trending== "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">عنوان دلالي</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$product->meta_title}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">كلمات تعريفية</label>
                        <textarea name="meta_kewwords"  class="form-control"  style="resize: none ;">{{$product->meta_kewwords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">وصف دلالي</label>
                        <textarea name="meta_descrip"  class="form-control"  style="resize: none;">{{$product->meta_descrip}}</textarea>
                    </div>
                    @if ($product->img)
                    <img class="w-40" src="{{asset('assets/uploads/product/'.$product->img)}}" alt="no picture">
                    @endif
                    <br>
                    <div class="col-md-12 mb-3">
                        <input type="file"  name="image" class="form-control-file">
                    </div>
                    <input type="submit"  value="عدل" class="btn btn-primry">

                </div>

            </form>
        </div>
</div>
@endsection

