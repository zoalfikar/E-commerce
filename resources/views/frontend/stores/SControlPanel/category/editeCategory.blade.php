@extends('layouts.userControllPanel')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>Edit Category</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/edit-category/'.$category->id)}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">description</label>
                        <textarea name="description"  class="form-control"  style="resize: none;">{{$category->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">status</label>
                        <input type="checkbox"  name="status" {{ $category->status== "1" ? 'checked':''}} >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">popular</label>
                        <input type="checkbox"  name="popular" {{ $category->populer== "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$category->meta_title}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">meta_keywords</label>
                        <textarea name="meta_keywords"  class="form-control"  style="resize: none;"> {{$category->meta_kewwords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">meta_descrip</label>
                        <textarea name="meta_descrip"  class="form-control"  style="resize: none;">{{$category->meta_descrip}}</textarea>
                    </div>
                    @if ($category->img)
                    <img class="w-40" src="{{asset('assets/uploads/category/'.$category->img)}}" alt="no picture">
                    @endif
                    <br>
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" class="form-control-file">
                    </div>
                    <input type="submit"  value="edit" class="btn btn-primry">

                </div>

            </form>
        </div>
</div>
@endsection
