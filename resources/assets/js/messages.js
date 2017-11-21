/**
 * Send chat messages
 */
console.log('messages');
$('#chat-message').keydown(function(e){
    let message = $(this).val(),
        type = $(this).attr('data-type'),
        user = $(this).attr('data-user-id');
    if(e.which === 13){
        e.preventDefault();
        if(message.length > 0){
            if(type === 'new'){
                $('#new-con-form').submit();
            }else{
                let con_id = $(this).attr('data-conversation-id');
                postMessage(user, message, con_id);
            }

        }else{
            toastr.error('Message cannot be empty.');
        }
    }
});

/**
 * Post message
 * @param user
 * @param message
 * @param con_id
 */
function postMessage(user, message, con_id){
    console.log(user, message, con_id);

    $.ajax({
        type : 'POST',
        url : '/user/message/new',
        data : {
            user_id : user,
            message : message,
            con_id : con_id,
            _token : $('meta[name=_token]').attr('content'),
        },
        success : function(res){
            if(res.created){
                $('.messages-content').find('.thread').append(getMessageDOM(message));
                $('.thread').scrollTop($('.thread')[0].scrollHeight);
                clearChatMessage();
            }
        }
    })
}

/**
 * Returns new message DOM
 * @param message
 * @returns {string}
 */
function getMessageDOM(message){
    return `
            <div class="your-message">
                ${message}
            </div>`;
}

/**
 * Clear chat message
 */
function clearChatMessage(){
    $("#chat-message").val('');
}

/**
 * Remove conversations
 */
$('.remove-conversation').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-conversation-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this conversation?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    type : 'DELETE',
                    url : '/user/conversation/',
                    data : {
                        _token : $('meta[name=_token]').attr('content'),
                        id : id
                    },
                    success: function(res){
                        if(res.deleted){
                            window.location = '/user/messages';
                        }
                    }

                })
            }
        }
    });
});