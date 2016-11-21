@extends('layouts.app')


@section('content')
    
    <style type="text/css">
        html, body { height: 100%; margin: 0; padding: 0; }
        #map-canvas { height: 710px }
        #map { height: 500px }
    </style>
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('home') !!}
        </div>
    </div>

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">Все маркеры</div>
      <div class="panel-body">
        <div class="col-md-9">
          <div id="map"></div>
        </div>
        <div class="col-md-3">
          <div class="panel-group acc-v1" id="accordion-1">
            <div class="panel panel-default">

            @php
                $test = [];
                foreach ($markers as $marker) {
                    $test[] = [ $marker->city, $marker->inner_title, $marker->id ];
                }

                $city = array();
                $address = array();

                for($r=0; $r < count($test); $r++)
                {
                    $city[$r] = $test[$r][0];
                }

                $unique = array_unique($city);

                $count = 0;
            @endphp

            @for($i = 0; $i < count($unique); $i++)
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" href="#collapse-{{ $count }}" aria-expanded="true">{{ $unique[$i] }}</a>
                </h4>
              </div>
              <div id="collapse-{{ $count }}" class="panel-collapse collapse" aria-expanded="true">
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-md-12">
                              @for($j=0; $j < count($test); $j++)
                                  @if($test[$j][0] == $unique[$i])
                                    <ul>
                                      <li><a href="#" data-id="{{ $test[$j][2] }}" class="map-link">{{ $test[$j][1] }}</a></li>
                                    </ul>
                                  @endif
                              @endfor
                          </div>
                      </div>
                  </div>
              </div>
            @php $count++ @endphp
            @endfor


            </div>
          </div>
          @if( Auth::user() )
            <a class="btn btn-danger" href="{{ route('add_new_marker') }}">Добавить новый маркер</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>



<script>

$.getScript("//maps.googleapis.com/maps/api/js?key=AIzaSyC6M9R7qu0PEnSqR-J0rBUzNPyUri_h3q8&language=ru",
    function (data, textStatus, jqxhr) {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.4840397, lng: 31.1389815},
            zoom: 6
        });

        var beaches = [
          @foreach ($markers as $marker)
            ['{{ $marker->id }}',
              '{{ $marker->inner_title }}',
              {{ $marker->lat }},
              {{ $marker->lng }},
              '{!! $marker->content !!}',
              '{{ $marker->city }}'],
          @endforeach
    ];

       var markersArray = [];

       var image = {
           url: '/images/map.png'
       };

       var infoPopup = new google.maps.InfoWindow();

       for (var i = 0; i < beaches.length; i++) {
           var store = beaches[i];

           var marker = new google.maps.Marker({
               position: {lat: store[2], lng: store[3]},
               map: map,
               icon: image,
               store_id: store[0],
               title: store[1],
               content: store[4]
           });

           markersArray[store[0]] = marker;

           marker.addListener('click', function () {
               setAndOpenStore(this.store_id);
           });
       }

       function setAndOpenStore(id_store) {

           var _marker = markersArray[id_store];
           map.setZoom(Number(17));
           map.panTo(_marker.getPosition());
           infoPopup.close();
           infoPopup.setContent(_marker.content);
           infoPopup.open(map, _marker);

       }

       $(".map-link").on("click", function () {
           setAndOpenStore($(this).data("id"));
           return false;
       });
   });

  /*https://viridis.ua/ru/internet-pharmacy/*/
</script>

@endsection


