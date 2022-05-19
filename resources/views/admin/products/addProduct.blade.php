@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            <h1>add new product</h1>
        </div>
        <div class="card-body" >
            <form id="myform" action="{{url('/insert-product')}}" method="POST" enctype="multipart/form-data" >

                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3 ">
                        <select name="cat_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option selected>choose category</option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                          </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug">slug</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">small description</label>
                        <textarea name="small_description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">description</label>
                        <textarea name="description"  class="form-control"  style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="orginal_price">orginal price</label>
                        <input type="text" class="form-control" name="orginal_price" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">selling price</label>
                        <input type="text" class="form-control" name="selling_price" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty"> qty </label>
                        <input type="text" class="form-control" name="qty" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tax"> tax </label>
                        <input type="text" class="form-control" name="tax" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">status</label>
                        <input type="checkbox"  name="status" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">trending</label>
                        <input type="checkbox"  name="trending">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">meta_keywords</label>
                        <textarea name="meta_kewwords"  class="form-control"  style="resize: none;"></textarea>
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
