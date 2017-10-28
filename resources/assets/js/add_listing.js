APP.SUBMIT_LISTING = () => {
    let geocoder,
        map,
        marker,
        myDropzone,
        action = $('.submit-property').attr('data-action'),
        coords = (action === 'edit') ? {lat : parseFloat($('.submit-property').attr('data-lat')), lng : parseFloat($('.submit-property').attr('data-lng'))} : null,
        listing_id = (action === 'edit') ? $('.submit-property').attr('data-listing-id') : null,
        remove_queue = [];

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
            $('#dropzone').addClass('dropzone');
            if(action === 'edit'){
                $.ajax({
                    type : 'GET',
                    url : '/property/images',
                    data : {
                        id : listing_id
                    },
                    success : function(images){
                        $.map(images, function(image){
                            var mockFile = {
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
                        window.location = '/user/properties';
                    }
                });

                this.on("maxfilesexceeded", function() {
                    console.log(this.files);
                });
            }
        }
    });

    let getQueuedFilesCount = (files) =>{
        let counter = 0;
        $.map(files, function(file){
            console.log(file);
            if(file.status === 'queued'){
                counter++;
            }
        });
        return counter;
    };

    let getFailedFilesCount = (files) => {
        let counter = 0;
        $.map(files, function(file){
            console.log(file);
            if(file.status === 'error'){
                counter++;
            }
        });
        return counter;
    };

    $("#submit-listing").on('click', function(e){
        e.preventDefault();
        let name = $("#property_title").val(),
            description = $("#description").val(),
            price = $("#price").val(),
            land_area = $("#land_area").val(),
            area_units = $("#area_units").val(),
            expire_after = $("#expire_after").val(),
            purpose = $("#purpose").val(),
            propertyType = $("#propertyType").val(),
            subType = $('#subType').val(),
            city = $("#city").val(),
            location = $("#location").val(),
            lat = $("#lat").val(),
            lng = $("#lng").val();

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
        })
    });

    let createListing = (
        name, description, price, land_area,
        area_units, expire_after, purpose,
        propertyType, subType, city, location,
        lat,lng
    ) => {
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
    };

    let uploadListingImages = () => {
        myDropzone.processQueue();
    };

    let updateListing = (
        name, description, price, land_area,
        area_units, expire_after, purpose,
        propertyType, subType, city, location,
        lat,lng
    ) => {
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
    };

    let executeRemoveQueue = (queue) => {
        $.ajax({
            type : 'DELETE',
            url : '/upload',
            data : {
                _token : $('meta[name=_token]').attr('content'),
                images : queue
            }
        })
    };


    $("#city").on('change', function(e){
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

    $("#location").on('change', function(e){
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


    $('#propertyType').on('change', function(e){
        if(this.value.length){
            renderSubType(this.value);
            showSubTypes();
        }else{
            clearSubTypes();
            hideSubTypes();
        }
    });

    let renderSubType = (type) => {

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
            $('#subType').append($type);
        });
    };

    let clearSubTypes = () => {
        $('#subType').empty().append('<option value="">Select Sub Type</option>');
    };

    let hideSubTypes = () => {
        $('.sub-types').hide();
    };


    let showSubTypes = () => {
        $('.sub-types').show();
    };


    let placeMarker = (location) => {
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


    let initListingsMap = (lat,lng) => {
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
    };

    let setListingCoords = (lat,lng) => {
        $('#lat').val(lat);
        $('#lng').val(lng);
    };

    let removeListingCoords = () => {
        $('#lat').val('');
        $('#lng').val('');
    };

    let renderListingErrors = (errors) => {
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


    let clearListingErrors = () => {
        $('.listing-errors > .errors').empty();
    };

    function getKeySafeName(str) {
        return str// insert a space before all caps
            .replace(/([A-Z])/g, ' $1')
            // uppercase the first character
            .replace(/^./, function(str){ return str.toUpperCase(); })
    }


    let renderLocationList = (locations) => {
        clearLocations();
        $.map(locations, function(town, index) {
            let $location = `<option value="${town.id}" data-name="${town.name}">${town.name}</option>`;
            $('#location').append($location);
        });
        $(".selectpicker").selectpicker('refresh');
    };


    let clearLocations = () => {
        $('#location').empty().append('<option value="">Select from list</option>');
    };


    let hideLocations = () => {
        $('.available-towns').hide();
    };

    let showLocations = () => {
        $('.available-towns').show();
    };

    let toggleListingMap = (action) => {
        switch(action){
            case 'hide':
                $('.location-map').hide();
                break;
            case 'show':
                $('.location-map').show();
                break;
        }
    };

    let clearMarkers = (marker) => {
        marker.setMap(null);
    };
};