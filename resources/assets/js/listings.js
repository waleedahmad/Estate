$('.remove-listing').on('click', function(e){
    let id = $(this).attr('data-id');
    console.log(id);
    bootbox.confirm({
        message: "Are you sure you want to delete this property listing?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: 'No',
                className: 'btn-default'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    type : 'DELETE',
                    url : '/user/listing',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.removed){
                            $(this).parents('.my-property').slideUp().remove();
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});


$('.listing-fav-toggle').on('click', function(e){
    let id = $(this).attr('data-id'),
        status = parseInt($(this).attr('data-status'));

    console.log(id, status);

    $.ajax({
        type : 'POST',
        url : '/user/properties/toggle_favorite',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            id : id,
            status : status === 1 ? 0 : 1
        },
        success : function(res){
            if(res){
                $(this).attr('data-status', status === 1 ? status - 1 : status +1);
                $(this).text(status === 1 ? 'Add to Favorites' : 'Remove from Favorites');
            }
        }.bind(this)
    })
});

$('.remove-fav-listing').on('click', function(e){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to remove this property from favorites?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: 'No',
                className: 'btn-default'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    type : 'POST',
                    url : '/user/properties/remove_favorite',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id,
                    },
                    success : function(res){
                        if(res){
                            $(this).parents('.my-property').remove();
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});

$('.youtube-link').on('click', function(e){
    let id = $(this).attr('data-id');
    $.ajax({
        type : 'GET',
        url : '/admin/listings/youtube',
        data : {
            id : id
        },
        success : function(res){
            bootbox.prompt({
                title: "Youtube Embed code!",
                inputType: 'textarea',
                value : res,
                callback: function (code) {
                    if(code){
                        createListingMedia(id, code);
                    }
                }
            });
        }
    })
});

function createListingMedia(id, code){
    $.ajax({
        type : 'POST',
        url : '/admin/listings/youtube',
        data : {
            id : id,
            code : code,
            _token : $('meta[name=_token]').attr('content'),
        },
        success : function(res){
            if(res){
                toastr.success('Youtube media link created');
            }
        }
    })
}