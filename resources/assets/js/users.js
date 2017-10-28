$('.user-type').on('change', function(e){
    let type = $(this).val(),
        user_id = $(this).attr('data-user-id');

    $.ajax({
        type : 'POST',
        url : '/admin/user/modify_type',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            id : user_id,
            type : type
        },
        success : function(res){
            if(res){
                toastr.success('Type change to : '+ type);
            }
        }
    });

});

$('.toggle-agent').on('click', toggleAgent);

function toggleAgent() {
    let id = $(this).attr('data-id'),
        status = parseInt($(this).attr('data-status'));

    $.ajax({
        type : 'POST',
        url : '/admin/agents/toggle_featured',
        data : {
            _token : $('meta[name=_token]').attr('content'),
            id : id,
            status : status === 1 ? 0 : 1
        },
        success : function(res){
            if(res){
                $(this).attr('data-status', status === 1 ? status - 1 : status +1);
                $(this).text(status === 1 ? 'Add to Recent' : 'Remove from Recent');
            }
        }.bind(this)
    })
}

