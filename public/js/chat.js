
const messages = $('#messages');
// const username = $('#username');
// const message = $('#message_input');
const form = $('#messageform');

form.on('submit', function (e) {
    e.preventDefault()

    var username = $('#username');
    var message = $('#message_input');
    let has_errors = false;


    if (username.val() == '') {
        alert('Please enter a username');
        has_errors = true;
    }


    if (message.val() == '') {
        alert('Please enter a message');
        has_errors = true;
    }

    if (has_errors) {
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    $.ajax({
        method: 'post',
        url: '/admin/send-message',
        data: {
            username: username.val(),
            message: message.val()
        },
        success: function (response) {

        }
    });


});

 // Enable pusher logging - don't include this in production
 Pusher.logToConsole = true;
 
 
 var pusher = new Pusher('17fa4f4b0fd173932013', {
   cluster:'eu'
 });

 var channel = pusher.subscribe('chat');
 channel.bind('.message', function(data) {
    //    alert(JSON.stringify(data));
    console.log(data);
 });


// window.Echo.channel('chat')
//     .listen('.message', function (e) {
//         console.log(e);
//     })
