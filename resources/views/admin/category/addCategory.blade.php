@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>add new category</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/insert-category')}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">slug</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">description</label>
                        <textarea name="description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">status</label>
                        <input type="checkbox"  name="status" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">popular</label>
                        <input type="checkbox"  name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">meta_keywords</label>
                        <textarea name="meta_keywords"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">meta_descrip</label>
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
