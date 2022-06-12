@extends('layouts.frontend')

@section('title')

    stores

@endsection



@section('content')

    <div class="float-start" id="map"></div>
    <div class="float-end"  style="width:30%; height:30%; background-color:rgb(250, 250, 255); ">
        <img src="{{asset('assets/uploads/stores/'.$store->img)}}" class="img-responsive" style="border-radius: 50%; width:100%; height:100%; ">
    </div>
    <div  class="float-end"  style="width:30%; height:30%;">
        <div  class="float-center"><h3>{{$store->name}}</h3></div>
        <p>{{$store->description}}</p>
    </div>
    <div class="py-5">
        <div class="container">
            <h1>categorys</h1>
        </div>
    </div>

@endsection



@section('scripts')

    <script>

        let map;
        let marker;

        function initMap() {
            // The location of Uluru
            const uluru = { lat:{{$store->address_latitude}}, lng: {{$store->address_longitude}} };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
        window.initMap = initMap;

        // function changLocation(){
        //     const latlang = { lat: 33.5102, lng: 11.031 };
        //     marker.setPosition(latlang);
        //     map.setCenter(latlang);
        // }


    </script>

@endsection
