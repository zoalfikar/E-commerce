@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>اضافة منتج جديد </h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/insert-product')}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3 ">
                        <select name="cat_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected>اختر الفئة</option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                          </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name">اسم المنتج</label>
                        <input type="text" class="form-control" name="name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">كلمة مفتاحية</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">اضف وصف صغير</label>
                        <textarea name="small_description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">الوصف</label>
                        <textarea name="description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="orginal_price">السعر الاصلي</label>
                        <input type="text" class="form-control" name="orginal_price" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">السعر المطلوب</label>
                        <input type="text" class="form-control" name="selling_price" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty"> الكمية </label>
                        <input type="text" class="form-control" name="qty" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tax"> الضرائب </label>
                        <input type="text" class="form-control" name="tax" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">الحالة</label>
                        <input type="checkbox"  name="status" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">شائع</label>
                        <input type="checkbox"  name="trending">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">عنوان دلالي</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">كلمات مفتاحية</label>
                        <textarea name="meta_kewwords"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">وصف دلالي</label>
                        <textarea name="meta_descrip"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input type="file"  name="image" class="form-control-file">
                    </div>
                    <input type="submit"  value="اضف" class="btn btn-primry">

                </div>

            </form>
        </div>
</div>
@endsection
