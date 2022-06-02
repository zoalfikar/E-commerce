@extends('layouts.admin')
@section('content')
<div class="card">
        <div class="card-header">
            @isset($edit_language)
            <h1>edit language</h1>
            @else
            <h1>add new language</h1>
            @endisset
        </div>

        @isset($edit_language)

        <div class="card-body" >
            <form id="myform" action="{{url('/update-language/'.$edit_language->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" value="{{$edit_language->name}}" >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="abbr">abbr</label>
                        <input type="text" class="form-control" name="abbe" value="{{$edit_language->abbe}}" >
                        @error('abbe')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="locale">locale</label>
                        <input type="text" class="form-control" name="locale" value="{{$edit_language->locale}}" >
                        @error('locale')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <select name="direction" class="form-select form-select-lg mb-3 w-30" aria-label="Default select example">
                            <option>choose direction</option>
                            <option value="ltr" {{$edit_language->direction=='ltr'? 'selected' :''}}>lift to right</option>
                            <option value="rtl" {{$edit_language->direction=='rtl'? 'selected' :''}}>right to lift</option>
                          </select>
                          @error('direction')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="active">active</label>
                        <input type="checkbox"  name="active" {{$edit_language->active==1? 'checked' :''}}>
                        @error('active')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit"  value="edit" class="btn btn-primry">
                </div>
            </form>
            @else
            <form id="myform" action="{{url('/insert-language')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" >
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="abbr">abbr</label>
                        <input type="text" class="form-control" name="abbe">
                        @error('abbe')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="locale">locale</label>
                        <input type="text" class="form-control" name="locale" >
                        @error('locale')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <select name="direction" class="form-select form-select-lg mb-3 w-30" aria-label="Default select example">
                            <option selected>choose direction</option>
                            <option value="ltr">lift to right</option>
                            <option value="ltr">right to lift</option>
                        </select>
                        @error('direction')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="active">active</label>
                        <input type="checkbox"  name="active" >
                        @error('active')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit"  value="add" class="btn btn-primry">
                </div>
            </form>
        </div>
        @endisset
</div>
@endsection
