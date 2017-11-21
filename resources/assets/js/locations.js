$('.remove-city').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this city?",
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
                    url : '/admin/cities',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.city-block').slideUp().remove();
                        }else{
                            if(!res.allowed){
                                toastr.error(
                                    'This city cannot be removed because it currently has one or more towns associated with it',
                                    'Unable to delete City'
                                );
                            }
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});

$('.remove-town').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this town?",
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
                    url : '/admin/cities/town',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.town-block').slideUp().remove();
                        }else{
                            if(!res.allowed){
                                toastr.error(
                                    'This city cannot be removed because it currently has one or more towns associated with it',
                                    'Unable to delete City'
                                );
                            }
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});

$('.remove-block').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this block?",
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
                    url : '/admin/cities/town/block',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.block-block').slideUp().remove();
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});

