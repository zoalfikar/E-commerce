@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1> {{$category->name}}ترجم هذه الفئة</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/translet-category')}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">
                    <input type="hidden" name="transelet_of" value="{{$category->id}}">
                    <div class="col-md-6 mb-3">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" name="name" placeholder="{{$category->name}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">كلمة مفتاحية</label>
                        <input type="text" class="form-control" name="slug" placeholder="{{$category->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">الوصف</label>
                        <textarea name="description"  class="form-control"  style="resize: none;" placeholder="{{$category->description}}"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">الحالة</label>
                        <input type="checkbox"  name="status" {{ $category->status== "1" ? 'checked':''}} >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">شائع</label>
                        <input type="checkbox"  name="popular" {{ $category->populer== "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">عنوان دلالي</label>
                        <input type="text" class="form-control" name="meta_title" placeholder="{{$category->meta_title}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">كلمات مفتاحية</label>
                        <textarea name="meta_keywords"  class="form-control"  style="resize: none;" placeholder="{{$category->meta_kewwords}}"> </textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">وصف دلالي</label>
                        <textarea name="meta_descrip"  class="form-control"  style="resize: none;" placeholder="{{$category->meta_descrip}}"></textarea>
                    </div>
                    @if ($category->img)
                    <img class="w-40" src="{{asset('assets/uploads/category/'.$category->img)}}" alt="no picture">
                    @endif
                    <br>
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <input type="submit"  value="transelate" class="btn btn-primry">

                </div>

            </form>
        </div>
</div>
@endsection
