require('./bootstrap');

var messages_el = $('#messages');
var message_form = $('#message_form');

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
        datatype: "html",
        data:{
            message: message_input.val(),
        } ,
    }).done(function(response){
        html = response;
        message_input.val('');
    });

    
});

let get_message_html = async function(message){
    var url = "{{ route('conversations.messages.show',[ "+ message.conversaion.id +" , "+ message.id +"]) }}"
    
   return  await $.get(url);
    
}



window.Echo.channel(channel)
    .listen('Message', (e) => {
       
            messages_el.append( get_message_html(e.message) );
            // messages_el.append(`<div class="message"><strong>${e.message.message_content}</strong></div>`);
        });