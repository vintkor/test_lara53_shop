@extends('layouts.app')

<style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0; }
    #map { height: 500px }
</style>

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('home') !!}
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="map"></div>
        </div>
        <div class="col-md-4">add</div>
    </div>
</div>

<script type="text/javascript">

var map;
function initMap() {

    var myPosition = {lat: -33.890542, lng: 151.274856};
    var image = '/images/map.png';
    var beaches = [
        ['Bondi Beach', -33.890542, 151.274856, 4],
        ['Coogee Beach', -33.923036, 151.259052, 5],
        ['Cronulla Beach', -34.028249, 151.157507, 3],
        ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];


    var mapOptions = {
        center: myPosition,
        zoom: 11,
        mapTypeControl: false,
        streetViewControl: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    for (var i = 0; i < beaches.length; i++) {
        var beach = beaches[i];
        var marker = new google.maps.Marker({
          position: {lat: beach[1], lng: beach[2]},
          map: map,
          icon: image,
          title: beach[0],
          zIndex: beach[3]
        });
      }

}

</script>

@endsection
