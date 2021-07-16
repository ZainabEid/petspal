$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.fn.editable.defaults.mode = 'inline';

    $.fn.editable.defaults.ajaxOptions = {type: "PUT"};

    console.log('sddfsdf');
    $('.xedit').editable({
        success: function(response, newValue) {
            console.log(response);
            if(response.status == 'error') console.log(response.msg);  //msg will be shown in editable form
        },
        error: function(error){
            console.log(error);
            var response = JSON.parse(error.responseText)
            if(error.status == 422) return error.responseJSON.errors.value[0];  //msg will be shown in editable form

        }
    });
});