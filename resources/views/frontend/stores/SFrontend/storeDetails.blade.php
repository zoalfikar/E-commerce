@extends('layouts.frontend')

@section('title')

    stores

@endsection



@section('content')

    @include('layouts/inct/frontendslider')
    <div id="map"></div>
    <div class="py-5">
        <div class="container">


        </div>
    </div>

@endsection



@section('scripts')

    <script>

        let map;
        let marker;

        function initMap() {
            // The location of Uluru
            const uluru = { lat:{{$data->latitude}}, lng: {{$data->longitude}} };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
        function changLocation(){
            const latlang = { lat: 33.5102, lng: 11.031 };
            marker.setPosition(latlang);
            map.setCenter(latlang);
        }
        window.initMap = initMap;


    </script>

@endsection
