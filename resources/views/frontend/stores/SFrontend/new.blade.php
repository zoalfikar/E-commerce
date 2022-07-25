@extends('layouts.frontend')

@section('title')

    new store

@endsection



@section('content')
    <div id="map" style="width: 100%; height:40%"></div>
    <div class="py-5">

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h1>create your store</h1>
                </div>
                <div class="card-body" >

                    <form  action="{{url('/create-store')}}" method="POST" enctype="multipart/form-data" >

                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name">name</label>
                                <input type="text" class="form-control" name="name" placeholder="enter your store name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug">slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="enter key words">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">description</label>
                                <textarea name="description"  class="form-control"  style="resize: none;">add a small description about your new store </textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ownerName">ownerName</label>
                                <input type="text" class="form-control" name="ownerName" value="{{$user->name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug">country</label>
                                <input type="text" class="form-control" name="country" value="{{$user->country}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug">city</label>
                                <input type="text" class="form-control" name="city" value="{{$user->city}}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <input type="file"  name="img" class="form-control-file">
                            </div>
                            <input type="hidden" id="Lat" value="{{lat($user->ipAdrees)}}" name="lat">
                            <input type="hidden" id="Lng" value="{{lng($user->ipAdrees)}}" name="lng">
                            <input type="submit"  value="add" class="btn btn-primry">

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('scripts')

    <script>


        let map;
        let marker;

        function initMap() {
            // The location of Uluru
            const uluru = { lat:{{lat($user->ipAdrees)}}, lng: {{lng($user->ipAdrees)}} };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable:true,
                title:"bla"
            });
            google.maps.event.addListener(marker, 'dragend', function (evt) {
                $("#Lat").val(evt.latLng.lat().toFixed(6));
                $("#Lng").val(evt.latLng.lng().toFixed(6));
            });
        }
        window.initMap = initMap;


    </script>

@endsection
