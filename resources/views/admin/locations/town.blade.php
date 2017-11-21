@extends('layout')

@section('title')
    {{$town->name}} -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    {{$town->name}}, {{$town->city->name}}
                </h3>

                <a href="/admin/cities/town/{{$town->id}}/block/add">
                    <button style="margin-left: 10px;"  class="buttonGrey">Add Block</button>
                </a>

                <a href="/admin/cities/{{$town->city->id}}">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 cities">
            <div class="col-lg-6">
                <div id="town-form-map" style="width: 100%; height: 480px;"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 cities" style="margin-top: 20px;">
            @foreach($town->blocks as $block)
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 block-block">
                    <a href="/admin/cities/town/block/{{$block->id}}">
                        <div class="city">
                            {{$block->name}}

                            <span class="glyphicon glyphicon-remove remove-block" data-id="{{$block->id}}" aria-hidden="true"></span>
                            <a href="/admin/cities/town/block/{{$block->id}}/edit">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endSection


@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA"></script><!-- google maps -->
    <script>
        var geocoder;
        var map;
        var marker;

        function placeMarker(location) {
            if (marker == null) {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    zoom: 14
                });
            } else {
                marker.setPosition(location);
            }
        }

        function codeAddress(address) {
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    placeMarker(results[0].geometry.location);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
        //intialize the map
        function initTownMaps() {
            var mapOptions = {
                zoom: 14,
                center: new google.maps.LatLng(29.9472606,69.32086)
            };

            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('town-form-map'), mapOptions);
        }
        initTownMaps();
        codeAddress('{{$town->name}} {{$town->city->name}}')
    </script>

    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection


