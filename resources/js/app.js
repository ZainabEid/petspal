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
        // html = response;
        message_input.val('');
    });

    
});

// let get_message_html = async function(message){
//     var url = "{{ route('conversations.messages.show',[ "+ message.conversaion.id +" , "+ message.id +"]) }}"
    
//    return  await $.get(url);
    
// }

function left(message){
   return  `<li class="chat-left">

                <div class="chat-avatar">

                    <img src=" ${message.sender.avatar}" alt="${message.sender.name}">
                    <div class="chat-name">${message.sender.name}</div>
                    
                </div>

                <div class="chat-text">${message.message_content}</div>

                <div class="chat-hour">
                    ${message.time_ago}
                </div>
            </li>`;
}


function right(message){
    return  `
        <li class="chat-right">
            <div class="chat-hour">

                ${message.time_ago}

            </div>
            <div class="chat-text">${message.message_content}</div>
            <div class="chat-avatar">
                <img src="${message.sender.avatar}" alt="${message.sender.name}">
                <div class="chat-name">${message.sender.name}</div>
            </div>
        </li>
        `;
 }





window.Echo.channel(channel)
    .listen('Message', (e) => {
        alert('message is '+ e.message.message_content);
    //     alert(__auth().id + '  '+e.message.sender_id );
    //   if(e.message.sender_id === __auth().id )  {

    //       messages_el.append( left(e.message) );
    //   }else{
    //       messages_el.append( right(e.message) );

    //   }
            // messages_el.append(`<div class="message"><strong>${e.message.message_content}</strong></div>`);
        });