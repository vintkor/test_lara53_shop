@extends('layouts.app')

@push('scripts')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyC6M9R7qu0PEnSqR-J0rBUzNPyUri_h3q8&language=ru"></script>
    <style type="text/css">
        html, body { height: 100%; margin: 0; padding: 0; }
        #map-canvas { height: 710px }
    </style>
    @endpush

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('home') !!}
        </div>
    </div>

<div class="container">
    <div class="row">        
        <div class="panel panel-default">
            <div class="panel-heading">
                Добавление маркера
            </div>
            <div class="panel-body">
                <div class="col-md-9">
                    <div id="map-canvas"></div>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('add_marker') }}" method="post" class="form" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        {{-- Поиск по аддресу by Google --}}
                        <div class="form-group">
                            <label for="searchmap">Аддрес Google - не добавляет</label>
                            <input type="" id="searchmap" name="searchmap" class="form-control">
                        </div>
                        <p class="text-danger">Перетащите маркер на карте в нужное место.</p>
                        <input type="hidden" id="lat" name="lat" class="form-control" readonly>
                        <input type="hidden" id="lng" name="lng" class="form-control" readonly>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input type="city" name="city" id="city" class="form-control">
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
// ========== Добавление маркера ============

$('#lat').val(50.42497789999999);
$('#lng').val(30.459857599999964);

var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center: {
        lat: 50.42497789999999,
        lng: 30.459857599999964
    },
    zoom: 6
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
