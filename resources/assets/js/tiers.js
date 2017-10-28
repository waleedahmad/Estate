$('.delete-tier').on('click', function(){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this Tier?",
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
                    url : '/admin/config/tiers',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.tier').slideUp().remove();
                        }else{
                            if(res.error_type === 'assigned'){
                                toastr.error('You cannot delete this tier because it is assigned to one of your users','Unable to delete  Tier');
                            }
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});

$('.user-tier').on('change', function(e){
    e.preventDefault();
    let id = $(this).val(),
        user_id = $(this).attr('data-user-id');

    $.ajax({
        type : 'POST',
        url : '/admin/users/tiers',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            tier_id : id,
            id : user_id,
        },
        success : function(res){
           if(res){
               toastr.success('Tier updated')
           }
        }
    });
});