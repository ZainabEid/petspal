require('./bootstrap');


var messages_el = $('#messages');
var username_input = $('#username');
var message_input = $('#message_input');
var message_form = $('#message_form');

message_form.on('submit',function(e){
    e.preventDefault();

    let has_errors = false;

    if(username_input.val()==''){
        alert('please enter username');
        has_errors = true;
    }

    if(message_input.val()==''){
        alert('please enter message');
        has_errors = true;
    }

    if(has_errors){
        return;
    }

    const options = {
        method: 'post',
        url: '/send-message',
        data:{
            username:username_input.val(),
            message: message_input.val(),
        }
    }

    axios(options);
    
});

window.Echo.channel('chat')
    .listen('.message', (e) => {
        console.log('success');
        console.log(e);
    });