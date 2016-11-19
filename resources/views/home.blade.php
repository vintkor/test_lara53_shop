@extends('layouts.app')

<style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0; }
    #map-canvas { height: 710px }
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

        {{-- Отображение маркеров --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                Все маркеры
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>

        {{-- Добавление маркера --}}
        <div class="panel panel-default">
            <div class="panel-heading">
                Добавление маркера
            </div>
            <div class="panel-body">
                <div class="col-md-8">
                    <div id="map-canvas"></div>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('add_marker') }}" method="post" class="form" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        {{-- Поиск по аддресу by Google --}}
                        <div class="form-group hidden">
                            <label for="title">Аддрес</label>
                            <input type="hidden" id="searchmap" class="form-control">
                        </div>
                        <p class="text-warning">Перетащите маркер на карте в нужное место.</p>
                        <input type="hidden" id="lat" name="lat" class="form-control" readonly>
                        <input type="hidden" id="lng" name="lng" class="form-control" readonly>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="city" name="city" id="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inner_title">Аддрес</label>
                            <input type="inner_title" name="inner_title" id="inner_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="string_1">Первая строка</label>
                            <input type="string_1" name="string_1" id="string_1" class="form-control">
                        </div><div class="form-group">
                            <label for="string_2">Вторая строка</label>
                            <input type="string_2" name="string_2" id="string_2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="string_3">Третья строка</label>
                            <input type="string_3" name="string_3" id="string_3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="icon">Цвет маркера</label>
                            <select name="icon" class="form-control">
                                <option name="icon" value="red">Красынй</option>
                                <option name="icon" value="blue">Синий</option>
                            </select>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="check" id="check" onchange="document.getElementById('add_marker').disabled = !this.checked;">
                                 Вы хотите добавить этот аддрес?
                            </label>
                          </div>
                        <button id="add_marker" class="btn btn-primary" disabled="true">Добавить метку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
// ========== Отображение маркеров ============    

    var map = new google.maps.Map(document.getElementById('map'),{
        center: {
            lat: 50.42497789999999,
            lng: 30.459857599999964
        },
        zoom: 10
    });

    var myBubles = {!! json_encode($data) !!};
    var marker = [];

    for(var i = 0; i < myBubles.length ; i++){
        var myOption = { content: myBubles[i].content };
        var superInfo = new google.maps.InfoWindow(myOption);

        marker[i] = new google.maps.Marker({
            position: { lat: myBubles[i].lat, lng: myBubles[i].lng },
            map: map,
            title: myBubles[i].inner_title,
            icon: myBubles[i].icon
        });
        
        marker[i].addListener('click', function() {
            superInfo.open(map, marker[i]);
        });

    }

</script>

{{-- <script type="text/javascript">
// ========== Отображение маркеров ============    

    var map = new google.maps.Map(document.getElementById('map'),{
        center: {
            lat: 50.42497789999999,
            lng: 30.459857599999964
        },
        zoom: 10
    });



    var position_marker_1 = {
        lat: 50.42497789999999,
        lng: 30.459857599999964
    };

    var content_marker_1 = 
        '<div id="content"><div id="siteNotice"></div>'+
            '<h1 id="firstHeading" class="firstHeading">Заголовок</h1>'+
            '<div id="bodyContent">'+
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Первая строка</p>' +
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Вторая строка</p>' +
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Третья строка</p>' +
            '</div>'+
        '</div>';

    var info_marker_1 = new google.maps.InfoWindow({
        content: content_marker_1
    });

    var marker_1 = new google.maps.Marker({
        position: position_marker_1,
        map: map,
        title: 'Заголовок маркера 1',
        icon: '/images/map.png'
    });
    
    marker_1.addListener('click', function() {
        info_marker_1.open(map, marker_1);
    });



    var position_marker_2 = {
        lat: 50.43984898790612,
        lng: 30.649371760156214
    };

    var content_marker_2 = 
        '<div id="content"><div id="siteNotice"></div>'+
            '<h1 id="firstHeading" class="firstHeading">Заголовок</h1>'+
            '<div id="bodyContent">'+
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Первая строка</p>' +
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Вторая строка</p>' +
                '<p><i class="fa fa-phone" aria-hidden="true"></i> Третья строка</p>' +
            '</div>'+
        '</div>';

    var info_marker_2 = new google.maps.InfoWindow({
        content: content_marker_1
    });

    var marker_2 = new google.maps.Marker({
        position: position_marker_2,
        map: map,
        title: 'Заголовок маркера 2',
        icon: '/images/map.png'
    });
    
    marker_2.addListener('click', function() {
        info_marker_2.open(map, marker_2);
    });

</script> --}}

<script type="text/javascript">
// ========== Добавление маркера ============

$('#lat').val(50.42497789999999);
$('#lng').val(30.459857599999964);

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center: {
        lat: 50.42497789999999,
        lng: 30.459857599999964
    },
    zoom: 10
});

var marker = new google.maps.Marker({
    position: {
        lat: 50.42497789999999,
        lng: 30.459857599999964
    },
    map: map,
    draggable: true,
    icon: '/images/map.png'
});

var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

google.maps.event.addListener(searchBox, 'places_changed', function(){

    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;

    for(i=0; place = places[i]; i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location);
    }

    map.fitBounds(bounds);
    map.setZoom(17);

});

google.maps.event.addListener(marker, 'position_changed', function(){

    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();

    $('#lat').val(lat);
    $('#lng').val(lng);

});

</script>

@endsection
