APP.ADD_BLOCK = () => {
    let geocoder,
        map,
        marker;

    let $add_town_form = $('.add-block').find('form'),
        $block = $('#block'),
        $lat = $('#loc-lat'),
        $lng = $('#loc-lng'),
        $coords = $('#long-lat');


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

    let getCityName = () => {
        return $($block).attr('data-city-name');
    };

    let getTownName = () => {
        return $($block).attr('data-town-name');
    };

    let getBlockName = () => {
        return $($block).val();
    };

    let displayCoords = (lat, lng) => {
        $($coords).html('<b>Lat :</b> ' + lat + ', <b>Lng :</b> ' +  lng);
    };

    let hideCoords  = () => {
        $($coords).empty();
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
        marker.setMap(map);
    };

    let clearMarker = () => {
        marker.setMap(null);
        clearCoords();
    };

    let clearCoords = () => {
        setLat('');
        setLng('');
        hideCoords();
    };

    let codeAddress = (address) => {
        console.log(address);
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                map.setZoom(15);
                placeMarker(results[0].geometry.location);
            } else {
                clearMarker();
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

    };

    $("#geocode-address").on('click', function(e){
        let block = getBlockName(),
            town = getTownName(),
            city = getCityName(),
            address = block + ' ' + town + ' ' + city;


        if(block.length){
            codeAddress(address);
        }else{
            toastr.error('Please provide a valid block name', 'Error')
        }

    });

    let setCords = (location) => {
        displayCoords(location.lat(), location.lng());
        $($block).attr('data-lat', location.lat()).attr('data-lng', location.lng());
        setLat(location.lat());
        setLng(location.lng());
    };

    initTownMaps();
};