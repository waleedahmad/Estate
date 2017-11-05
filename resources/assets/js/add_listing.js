APP.SUBMIT_LISTING = () => {

    let geocoder,
        map,
        marker,
        myDropzone,
        action = getSubmitAction(),
        coords = getListingCoordinates(),
        listing_id = getListingID(),
        remove_queue = [];

    let $submit_listing = $('#submit-listing'),
        $dropzone = $('#dropzone'),
        $name = $("#property_title"),
        $description = $("#description"),
        $price = $("#price"),
        $land_area = $("#land_area"),
        $area_units = $("#area_units"),
        $expire_after = $("#expire_after"),
        $purpose = $("#purpose"),
        $propertyType = $("#propertyType"),
        $subType = $('#subType'),
        $city = $("#city"),
        $location = $("#location"),
        $lat = $("#lat"),
        $lng = $("#lng");

    function getName(){
        return $($name).val();
    }

    function getDescription(){
        return $($description).val();
    }

    function getPrice(){
        return $($price).val();
    }

    function getLandArea(){
        return $($land_area).val();
    }

    function getAreaUnits(){
        return $($area_units).val();
    }

    function getExpireDate(){
        return $($expire_after).val();
    }

    function getPurpose(){
        return $($purpose).val();
    }

    function getPropertyType(){
        return $($propertyType).val();
    }

    function getPropertySubType(){
        return $($subType).val();
    }

    function getCity(){
        return $($city).val();
    }

    function getLocation(){
        return $($location).val();
    }

    function getLatitude(){
        return $($lat).val();
    }

    function getLongitude(){
        return $($lng).val();
    }

    function getSubmitAction(){
        return $($submit_listing).attr('data-action');
    }

    function getListingCoordinates(){
        return (getSubmitAction() === 'edit') ? {lat : parseFloat($($submit_listing).attr('data-lat')), lng : parseFloat($($submit_listing).attr('data-lng'))} : null;
    }

    function getListingID(){
        return (getSubmitAction() === 'edit') ? $($submit_listing).attr('data-listing-id') : null;
    }

    class Listing{

        constructor(){
            $($submit_listing).on('click', this.handleListingSubmission);
        }

        handleListingSubmission(e) {

            e.preventDefault();
            let name = getName(),
                description = getDescription(),
                price = getPrice(),
                land_area = getLandArea(),
                area_units = getAreaUnits(),
                expire_after = getExpireDate(),
                purpose = getPurpose(),
                propertyType = getPropertyType(),
                subType = getPropertySubType(),
                city = getCity(),
                location = getLocation(),
                lat = getLatitude(),
                lng = getLongitude();

            $.ajax({
                type : 'POST',
                url : '/user/listing/validate',
                data : {
                    _token : $('meta[name=_token]').attr('content'),
                    name : name,
                    description : description,
                    price: price,
                    land_area : land_area,
                    area_units : area_units,
                    expire_after : expire_after,
                    purpose : purpose,
                    propertyType : propertyType,
                    subType : subType,
                    city : city,
                    location : location,
                },
                success : function(res){
                    if(res.passes){
                        $('.listing-errors').hide();
                        if(action === 'add'){
                            if(!myDropzone.getQueuedFiles().length){
                                renderListingErrors({
                                    'image' :   'Please upload property pictures'
                                });
                            }else{
                                createListing(
                                    name, description, price, land_area,
                                    area_units, expire_after, purpose,
                                    propertyType, subType, city, location,
                                    lat,lng
                                );
                            }
                        }else{
                            console.log(remove_queue);
                            if(!myDropzone.files.length){
                                renderListingErrors({
                                    'image' :   'Please upload property pictures'
                                });
                            }else{
                                updateListing(
                                    name, description, price, land_area,
                                    area_units, expire_after, purpose,
                                    propertyType, subType, city, location,
                                    lat,lng
                                );
                            }
                        }
                    }else{
                        renderListingErrors(res.errors);
                        e.preventDefault();
                    }
                }
            });
        }
    }

    new Listing();

    Dropzone.autoDiscover = false;
    myDropzone = new Dropzone('div#dropzone', {
        url: "/upload",
        autoProcessQueue: false,
        addRemoveLinks: true,
        parallelUploads: 20,
        maxFiles: 20, //change limit as per your requirements
        dictMaxFilesExceeded: "Maximum upload limit reached",
        acceptedFiles: "image/*",
        dictInvalidFileType: "upload only JPG/PNG",
        maxFilesize: 2, // MB
        paramName : 'file',
        createImageThumbnails: true,

        sending: function(file, xhr, formData) {
            formData.append('listing_id', listing_id);
        },

        init : function(){
            $($dropzone).addClass('dropzone');
            if(action === 'edit'){
                $.ajax({
                    type : 'GET',
                    url : '/property/images',
                    data : {
                        id : listing_id
                    },
                    success : function(images){
                        $.map(images, function(image){
                            let mockFile = {
                                name: image.image_uri,
                                size: 12345,
                                type: 'image/jpeg',
                                status: Dropzone.ADDED,
                                url: '/storage/'+ image.image_uri,
                                accepted: true,
                                id : image.id
                            };

                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, '/image/'+ image.image_uri);
                            myDropzone.emit("complete", mockFile);
                            myDropzone.files.push(mockFile);
                        }.bind(this));
                    }.bind(this)
                });

                this.on('removedfile', function(file){
                    if(file.status === 'added'){
                        remove_queue.push(file.id);
                    }
                });

            }else if(action === 'add'){
                this.on('complete', function(){
                    if (!getFailedFilesCount(this.files) && this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        window.location = '/user/properties/pending';
                    }
                });

                this.on("maxfilesexceeded", function() {
                    console.log(this.files);
                });
            }
        }
    });

    function getQueuedFilesCount(files){
        let counter = 0;
        $.map(files, function(file){
            console.log(file);
            if(file.status === 'queued'){
                counter++;
            }
        });
        return counter;
    }

    function getFailedFilesCount(files){
        let counter = 0;
        $.map(files, function(file){
            console.log(file);
            if(file.status === 'error'){
                counter++;
            }
        });
        return counter;
    }



    function createListing(
        name, description, price, land_area,
        area_units, expire_after, purpose,
        propertyType, subType, city, location,
        lat,lng
    ){
        $.ajax({
            type : 'POST',
            url : '/user/submit_property',
            data: {
                _token : $('meta[name=_token]').attr('content'),
                name : name,
                description : description,
                price: price,
                land_area : land_area,
                area_units : area_units,
                expire_after : expire_after,
                purpose : purpose,
                propertyType : propertyType,
                subType : subType,
                city : city,
                location : location,
                lat : lat,
                lng : lng
            },
            success : function(res){
                console.log(res);
                if(res.created){
                    listing_id = res.listing_id;
                    uploadListingImages();
                }
            }
        })
    }

    let uploadListingImages = () => {
        myDropzone.processQueue();
    };

    function updateListing(
        name, description, price, land_area,
        area_units, expire_after, purpose,
        propertyType, subType, city, location,
        lat,lng
    ){
        $.ajax({
            type : 'POST',
            url : '/user/listing/update',
            data: {
                _token : $('meta[name=_token]').attr('content'),
                id : listing_id,
                name : name,
                description : description,
                price: price,
                land_area : land_area,
                area_units : area_units,
                expire_after : expire_after,
                purpose : purpose,
                propertyType : propertyType,
                subType : subType,
                city : city,
                location : location,
                lat : lat,
                lng : lng
            },
            success : function(res){
                if(res.updated){

                    if(remove_queue.length){
                        executeRemoveQueue(remove_queue);
                    }

                    if(getQueuedFilesCount(myDropzone.files)){
                        myDropzone.on('complete', function(){
                            if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                                window.location = '/property/'+listing_id;
                            }
                        });
                        uploadListingImages();
                    }else{
                        window.location = '/property/'+listing_id;
                    }
                }
            }
        })
    }

    function executeRemoveQueue(queue){
        $.ajax({
            type : 'DELETE',
            url : '/upload',
            data : {
                _token : $('meta[name=_token]').attr('content'),
                images : queue
            }
        })
    }


    $($city).on('change', function(e){
        removeListingCoords();
        if(this.value.length){
            let city_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/city/locations',
                data : {
                    id : city_id
                },
                success : function(res){
                    if(res.length){
                        showLocations();
                        renderLocationList(res);
                    }else{
                        clearLocations();
                        hideLocations();
                    }
                }
            });
        }else{

            clearLocations();
            hideLocations();
            toggleListingMap('hide');
            clearMarkers(marker);

        }
    });

    $($location).on('change', function(e){
        removeListingCoords();

        if(this.value.length){
            let id = this.value;
            $.ajax({
                type : 'GET',
                url : '/town/info',
                data : {
                    id : id
                },
                success : function(res){
                    if(res){
                        if(!map){
                            initListingsMap(res.coords.lat, res.coords.lng);
                            placeMarker({
                                lat : res.coords.lat,
                                lng : res.coords.lng
                            });
                        }else{
                            placeMarker({
                                lat : res.coords.lat,
                                lng : res.coords.lng
                            });
                        }
                        toggleListingMap('show');
                    }else{
                        toggleListingMap('hide');
                    }
                }
            });
        }else{
            toggleListingMap('hide');
            clearMarkers(marker);
        }
    });


    $($propertyType).on('change', function(e){
        if(this.value.length){
            renderSubType(this.value);
            showSubTypes();
        }else{
            clearSubTypes();
            hideSubTypes();
        }
    });

    function renderSubType(type){

        clearSubTypes();
        let types = {
            Home : [
                'House',
                'Flat',
                'Upper Portion',
                'Lower Portion',
                'Farm House',
                'Room',
                'Penthouse'
            ],
            Plots : [
                'Residential Plot',
                'Commercial Plot',
                'Agricultural Land',
                'Industrial Land',
                'Plot File',
                'Plot Form'
            ],
            Commercial : [
                'Office',
                'Shop',
                'Warehouse',
                'Factory',
                'Building',
                'Other'
            ]
        };
        $.map(types[type], function(type, index) {
            let $type = `<option value="${type}">${type}</option>`;
            $($subType).append($type);
        });
    };

    function clearSubTypes(){
        $($subType).empty().append('<option value="">Select Sub Type</option>');
    }

    function hideSubTypes(){
        $('.sub-types').hide();
    }


    function showSubTypes(){
        $('.sub-types').show();
    }


    function placeMarker(location){
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                zoom: 14
            });
        } else {
            marker.setPosition(location);
            marker.setMap(map);
        }
        map.setCenter(marker.getPosition());
    };


    function initListingsMap(lat,lng){
        let mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(lat,lng)
        };

        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('listing-form-map'), mapOptions);

        google.maps.event.addListener(map, 'click', function(event) {
            setListingCoords(event.latLng.lat, event.latLng.lng);
            placeMarker(event.latLng);
        });

        toggleListingMap('show');
    }

    function setListingCoords(lat,lng){
        $('#lat').val(lat);
        $('#lng').val(lng);
    }

    function removeListingCoords(){
        $('#lat').val('');
        $('#lng').val('');
    }

    function renderListingErrors(errors){
        clearListingErrors();
        $.map(errors, function(value, index) {
            let $err = `<ul>`;
            $err += `<li>
                        <b>${getKeySafeName(index.replace(/[_-]/g, " "))}</b> : ${value}
                    </li>`;
            $err += `</ul>`;
            $('.listing-errors > .errors').append($err)
        });
        $('.listing-errors').show();


        $('html, body').animate({
            scrollTop: $(".subHeader").offset().top
        }, 500);
    };


    function clearListingErrors(){
        $('.listing-errors > .errors').empty();
    }

    function getKeySafeName(str) {
        return str// insert a space before all caps
            .replace(/([A-Z])/g, ' $1')
            // uppercase the first character
            .replace(/^./, function(str){ return str.toUpperCase(); })
    }


    function renderLocationList(locations){
        clearLocations();
        $.map(locations, function(town, index) {
            let $loc = `<option value="${town.id}" data-name="${town.name}">${town.name}</option>`;
            $($location).append($loc);
        });
        $(".selectpicker").selectpicker('refresh');
    }

    function clearLocations(){
        $($location).empty().append('<option value="">Select from list</option>');
    };

    function hideLocations(){
        $('.available-towns').hide();
    }

    function showLocations(){
        $('.available-towns').show();
    };

    function toggleListingMap(action){
        switch(action){
            case 'hide':
                $('.location-map').hide();
                break;
            case 'show':
                $('.location-map').show();
                break;
        }
    }

    function clearMarkers(marker){
        marker.setMap(null);
    }

    if(action === 'edit'){
        if(!map){
            initListingsMap(coords.lat, coords.lng);
            placeMarker({
                lat : coords.lat,
                lng : coords.lng
            });
        }else{
            placeMarker({
                lat : coords.lat,
                lng : coords.lng
            });
        }
    }
};