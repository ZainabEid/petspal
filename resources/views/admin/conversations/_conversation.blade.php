@isset($conversation)

    {{-- sellected user  --}}
    <div class="selected-user">
        <span>{{ __('To:') }} <span class="name">{{ $conversation->talked_admin->name }}</span></span>
    </div>

    {{-- messages  --}}
    <div class="chat-container">

        <ul class="chat-box chatContainerScroll" id="messages">

            <!-- appended messages goes here -->
        
        </ul>

        <div class="form-group mt-3 mb-0 float-bottom">

            <form action="" id="message_form" method="post" data-url="{{ route('admin.conversations.messages.store',$conversation->id) }}">
                @csrf
                @method('post')
                <div class="row">

                    <div class="col-10">

                        <textarea class="form-control" rows="3" name="message" id="message_input" placeholder="Type your message here..."></textarea>

                    </div>

                    <div class="col-2">

                        <button type="submit" id="message_send" class="form-control btn btn-info btn-block "  style="text-align: center; line-height: 60px;" >
                            <i class="align-middle me-2" data-feather="send"></i> <span class="align-middle">{{ __('send') }}</span>
                        </button>

                    </div>

                </div>
                
            </form>

        </div>

    </div>

@endisset

{{-- onload get the conversation messages and load first five --}}
<script>
    var channel = '{{ $conversation->channel_name}}';
    alert(channel);
    
    var ENDPOINT = '{{ route("admin.conversations.show",$conversation->id) }}'; 
    var page = 1;

    infinteLoadMore(page);

    
    $(window).scroll(function () {
        
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });


    function infinteLoadMore(page) {
        $.ajax({
            url: ENDPOINT  +"?page=" + page,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.auto-load').show();
            }
        })
        .done(function (response) {
            if (response.length == 0) {
                $('.auto-load').html("We don't have more data to display :(");
                return;
            }
            $('.auto-load').hide();
            $("#messages").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
    } 


</script>

<script src="{{ asset('js/app.js') }}"></script>