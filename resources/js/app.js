require('./bootstrap');

window.Echo.channel('chat')
    .listen('Message', (e) => {
        messages_el.append(`<div class="message"><strong>${e.message}</strong></div>`);
    });