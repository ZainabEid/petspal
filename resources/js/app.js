require('./bootstrap');


var messages_el = $('#messages');
var message_input = $('#message_input');
var message_form = $('#message_form');

message_form.on('submit',function(e){
    e.preventDefault();

    alert('submit');

    let has_errors = false;
    var url = $(this).data('url');


    if(message_input.val()==''){
        alert('please enter message');
        has_errors = true;
    }

    if(has_errors){
        return;
    }

    const options = {
        method: 'post',
        url:  url,
        data:{
            message: message_input.val(),
        }
    }

    axios(options);
    
});

window.Echo.channel('chat')
    .listen('Message', (e) => {
        messages_el.append(`<div class="message"><strong>${e.message}</strong></div>`);
    });