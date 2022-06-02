@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>اضف صنف جديد</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/insert-category')}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" name="name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">تسمية مفتاحية</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">اضف وصف</label>
                        <textarea name="description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">الحالة</label>
                        <input type="checkbox"  name="status" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">شائع</label>
                        <input type="checkbox"  name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">عنوان دلالي</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">كلمات تعريفية</label>
                        <textarea name="meta_keywords"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">وصف دلالي</label>
                        <textarea name="meta_descrip"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input type="file"  name="image" class="form-control-file">
                    </div>
                    <input type="submit"  value="add" class="btn btn-primry">

                </div>

            </form>
        </div>
</div>
@endsection
