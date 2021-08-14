require('./bootstrap');

var messages_el = $('#messages');
var message_form = $('#message_form');
var html ='';

message_form.on('submit',function(e){
    e.preventDefault();
    
    var message_input = $('#message_input');
    
    let has_errors = false;
    var url = $(this).data('url');
    
    if(message_input.val()==''){
        alert('please enter message');
        has_errors = true;
    }

    if(has_errors){
        return;
    }


    $.ajax({
        type: "post",
        url: url,
        data:{
            message: message_input.val(),
        },
        success:function(response){
            html = response;
        }
    });

    
});

window.Echo.channel(channel)
    .listen('Message', (e) => {
            alert('channel is listening');
            messages_el.append(html);
            // messages_el.append(`<div class="message"><strong>${e.message.message_content}</strong></div>`);
        });