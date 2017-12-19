$('.delete-admin').on('click', function(e){
    let id = $(this).attr('data-id');
    console.log(id);
    bootbox.confirm({
        message: "Are you sure you want to delete this admin?",
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
                    url : '/admin/admins',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success : function(res){
                        if(res.deleted){
                            $(this).parents('.admin-row').slideUp().remove();
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});