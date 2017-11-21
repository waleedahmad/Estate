APP.SUBMIT_LISTING = () => {

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
        $subTypes = $('.sub-types'),
        $city = $("#city"),
        $town = $("#town"),
        $block = $("#block"),
        $lat = $("#lat"),
        $lng = $("#lng"),
        $town_DOM = $('.available-towns'),
        $block_DOM = $('.available-blocks'),
        $location_map = $('.location-map');

    let geocoder,
        map,
        marker,
        myDropzone,
        action = getSubmitAction(),
        coords = getListingCoordinates(),
        listing_id = getListingID(),
        remove_queue = [];
        console.log(action);


    /**
     * Listing Name
     * @returns {*|jQuery}
     */
    function getName(){
        return $($name).val();
    }


    /**
     * Listing Description
     * @returns {*|jQuery}
     */
    function getDescription(){
        return $($description).val();
    }

    /**
     * Listing Price
     * @returns {*|jQuery}
     */
    function getPrice(){
        return $($price).val();
    }

    /**
     * Listing Land Area
     * @returns {*|jQuery}
     */
    function getLandArea(){
        return $($land_area).val();
    }

    /**
     * Listing Area Units
     * @returns {*|jQuery}
     */
    function getAreaUnits(){
        return $($area_units).val();
    }

    /**
     * Listing Expire Date
     * @returns {*|jQuery}
     */
    function getExpireDate(){
        return $($expire_after).val();
    }

    /**
     * Listing Selling Purpose
     * @returns {*|jQuery}
     */
    function getPurpose(){
        return $($purpose).val();
    }

    /**
     * Listing Property Type
     * @returns {*|jQuery}
     */
    function getPropertyType(){
        return $($propertyType).val();
    }

    /**
     * Listing Property Sub Type
     * @returns {*|jQuery}
     */
    function getPropertySubType(){
        return $($subType).val();
    }

    /**
     * Listing City
     * @returns {*|jQuery}
     */
    function getCity(){
        return $($city).val();
    }

    /**
     * Listing Town
     * @returns {*|jQuery}
     */
    function getTown(){
        return $($town).val();
    }

    /**
     * Listing Block
     * @returns {*|jQuery}
     */
    function getBlock(){
        return $($block).val();
    }

    /**
     * Listing Longitude
     * @returns {*|jQuery}
     */
    function getLatitude(){
        return $($lat).val();
    }

    /**
     * Listing Latitude
     * @returns {*|jQuery}
     */
    function getLongitude(){
        return $($lng).val();
    }

    /**
     * Listing Submit Action
     * @returns {*|jQuery}
     */
    function getSubmitAction(){
        return $($submit_listing).attr('data-action');
    }

    /**
     * Listing Coordinates
     * @returns {*}
     */
    function getListingCoordinates(){
        return (getSubmitAction() === 'edit') ? {lat : parseFloat($($submit_listing).attr('data-lat')), lng : parseFloat($($submit_listing).attr('data-lng'))} : null;
    }

    /**
     * Listing ID
     * @returns {*}
     */
    function getListingID(){
        return (getSubmitAction() === 'edit') ? $($submit_listing).attr('data-listing-id') : null;
    }

    /**
     * Handle Listing City Change
     */
    $($city).on('change', function(e){
        if(this.value.length){
            let city_id = $(this).val();

            $.ajax({
                type : 'GET',
                url : '/city/towns',
                data : {
                    id : city_id
                },
                success : function(res){
                    if(res.length){
                        renderTownList(res);
                    }else{
                        hideTownLists();
                    }
                }
            });
        }else{
            hideTownLists();
        }
    });

    $($town).on('change', function(e){
        if(this.value.length){
            let id = this.value;
            $.ajax({
                type : 'GET',
                url : '/town/blocks',
                data : {
                    id : id
                },
                success : function(res){
                    if(res.length){
                        renderBlockList(res);
                    }else{
                        hideBlocksList();
                    }
                }
            });
        }else{
            hideBlocksList();
        }
    });

    $($block).on('change', function(e){
        if(this.value.length){
            let id = this.value;
            $.ajax({
                type : 'GET',
                url : '/block/info',
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
        $($subTypes).hide();
    }


    function showSubTypes(){
        $($subTypes).show();
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


    function clearListingErrors(){
        $('.listing-errors > .errors').empty();
    }

    function getKeySafeName(str) {
        return str// insert a space before all caps
            .replace(/([A-Z])/g, ' $1')
            // uppercase the first character
            .replace(/^./, function(str){ return str.toUpperCase(); })
    }


    function renderTownList(locations){
        clearTownLists();
        $.map(locations, function(town, index) {
            let $loc = `<option value="${town.id}" data-name="${town.name}">${town.name}</option>`;
            $($town).append($loc);
        });
        $(".selectpicker").selectpicker('refresh');
        showTownList();
    }

    function renderBlockList(locations){
        clearBlockLists();
        $.map(locations, function(block, index) {
            let $loc = `<option value="${block.id}" data-name="${block.name}">${block.name}</option>`;
            $($block).append($loc);
        });
        $(".selectpicker").selectpicker('refresh');
        showBlockList();
    }

    function clearTownLists(){
        $($town).empty().append('<option value="">Select from list</option>');
    };

    function clearBlockLists(){
        $($block).empty().append('<option value="">Select from list</option>');
    }

    function hideTownLists(){
        $($town_DOM).hide();
        clearTownLists();
        hideBlocksList();
        toggleListingMap('hide');
    }

    function hideBlocksList(){
        $($block_DOM).hide();
        clearBlockLists();
        toggleListingMap('hide');
    }

    function showTownList(){
        $($town_DOM).show();
    };

    function showBlockList(){
        $($block_DOM).show();
    };

    function toggleListingMap(action){
        switch(action){
            case 'hide':
                $($location_map).hide();
                clearMarkers(marker);
                break;
            case 'show':
                $($location_map).show();
                break;
        }
    }

    function clearMarkers(marker){
        marker.setMap(null);
        removeListingCoords();
    }

    class Listing{

        constructor(){
            $($submit_listing).on('click', this.handleListingSubmission.bind(this));
        }

        handleListingSubmission(e) {
            console.log(getTown());

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
                town = getTown(),
                block = getBlock(),
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
                    town : town,
                    block : block,
                },
                success : function(res){
                    console.log(action);
                    if(res.passes){
                        $('.listing-errors').hide();
                        if(action === 'add'){
                            if(!myDropzone.getQueuedFiles().length){
                                renderListingErrors({
                                    'image' :   'Please upload property pictures'
                                });
                            }else{
                                this.createListing(
                                    name, description, price, land_area,
                                    area_units, expire_after, purpose,
                                    propertyType, subType, city, block,
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
                                this.updateListing(
                                    name, description, price, land_area,
                                    area_units, expire_after, purpose,
                                    propertyType, subType, city, block,
                                    lat,lng
                                );
                            }
                        }
                    }else{
                        renderListingErrors(res.errors);
                        e.preventDefault();
                    }
                }.bind(this)
            });
        }

        createListing(
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
                        this.uploadListingImages();
                    }
                }.bind(this)
            })
        }

        updateListing(
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
                            this.executeRemoveQueue(remove_queue);
                        }

                        if(this.getQueuedFilesCount(myDropzone.files)){
                            myDropzone.on('complete', function(){
                                if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
                                    window.location = '/property/'+listing_id;
                                }
                            });
                            this.uploadListingImages();
                        }else{
                            window.location = '/property/'+listing_id;
                        }
                    }
                }.bind(this)
            })
        }

        uploadListingImages(){
            myDropzone.processQueue();
        }

        executeRemoveQueue(queue){
            $.ajax({
                type : 'DELETE',
                url : '/upload',
                data : {
                    _token : $('meta[name=_token]').attr('content'),
                    images : queue
                }
            })
        }

        getQueuedFilesCount(files){
            let counter = 0;
            $.map(files, function(file){
                console.log(file);
                if(file.status === 'queued'){
                    counter++;
                }
            });
            return counter;
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

    function setListingCoords(lat,lng){
        $('#lat').val(lat);
        $('#lng').val(lng);
    }

    function removeListingCoords(){
        $('#lat').val('');
        $('#lng').val('');
    }
};