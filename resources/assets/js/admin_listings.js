$('.approve-listing').on('click', function(e){
    let id = $(this).attr('data-id');
    console.log(id);
    bootbox.confirm({
        message: "Are you sure you want to approve this property listing?",
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
                    url : '/admin/listings/approve',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.approved){
                            $(this).parents('.listing-item').slideUp().remove();
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});

$('.delete-listing').on('click', function(e){
    let id = $(this).attr('data-id');
    console.log(id);
    bootbox.confirm({
        message: "Are you sure you want to delete this property listing submission?",
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
                    url : '/admin/listings/delete',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.listing-item').slideUp().remove();
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});

$('.disapprove-listing').on('click', function(e){
    let id = $(this).attr('data-id');
    console.log(id);
    bootbox.confirm({
        message: "Are you sure you want to disapprove this property listing submission?",
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
                    url : '/admin/listings/disapprove',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.disapproved){
                            $(this).parents('.listing-item').slideUp().remove();
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});



$('.toggle-slider').on('click', toggleSlider);
$('.toggle-recent').on('click', toggleRecent);


function toggleSlider(e) {
    let id = $(this).attr('data-id'),
        status = parseInt($(this).attr('data-status'));

    $.ajax({
        type : 'POST',
        url : '/admin/listings/display',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            id : id,
            action : 'slider',
            status : status === 1 ? 0 : 1
        },
        success : function(res){
            if(res){
                $(this).attr('data-status', status === 1 ? status - 1 : status +1);
                $(this).text(status === 1 ? 'Add to Slider' : 'Remove from Slider');
            }
        }.bind(this)
    })
}

function toggleRecent() {
    let id = $(this).attr('data-id'),
        status = parseInt($(this).attr('data-status'));

    $.ajax({
        type : 'POST',
        url : '/admin/listings/display',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            id : id,
            action : 'recent',
            status : status === 1 ? 0 : 1
        },
        success : function(res){
            if(res){
                $(this).attr('data-status', status === 1 ? status - 1 : status +1);
                $(this).text(status === 1 ? 'Add to Favorites' : 'Remove from Favorites');
            }
        }.bind(this)
    })
}

