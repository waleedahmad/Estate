APP.ADD_TOWN = () => {
    let geocoder,
        map,
        marker;

    let $add_town_form = $('.add-town').find('form'),
        $lat = $('#loc-lat'),
        $lng = $('#loc-lng');


    let getLat = () => {
        return $($lat).val();
    };

    let getLng = () => {
        return $($lng).val();
    };

    let setLat  = (lat) => {
        return $($lat).val(lat);
    };

    let setLng  = (lng) => {
        return $($lng).val(lng);
    };

    $($add_town_form).on('submit', function(e){
        if(!getLat().length && !getLng().length){
            e.preventDefault();
            toastr.error('Please select coordinates on google maps', 'Failed');
        }
    });

    let placeMarker = (location) => {
        setCords(location);
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        } else {
            marker.setPosition(location);
        }
    };

    let codeAddress = (address) => {
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                map.setZoom(15);
                placeMarker(results[0].geometry.location);
            } else {
                toastr.error(status, 'Geocode was not successful for the following reason');
            }
        });
    };

    let initTownMaps = () => {
        var mapOptions = {
            zoom: 8,
            center: new google.maps.LatLng(29.9472606,69.32086)
        };

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('town-form-map'), mapOptions);

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });
    };

    $("#geocode-address").on('click', function(e){
        var $town = $("#town"),
            town = $($town).val(),
            city = $($town).attr('data-city-name'),
            address = town + ' ' + city;

        codeAddress(address);
    });

    let setCords = (location) => {
        $("#long-lat").html('<b>Lat :</b> ' + location.lat() + ', <b>Lng :</b> ' +  location.lng());
        $("#town").attr('data-lat', location.lat()).attr('data-lng', location.lng());
        setLat(location.lat());
        setLng(location.lng());
    };

    initTownMaps();
};