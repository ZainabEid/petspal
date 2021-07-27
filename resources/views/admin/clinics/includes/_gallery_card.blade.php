<div class="modal-card">
    <header class="modal-card-head">
        <p class="modal-card-title"> {{ __('Clinic Gallery') }}</p>
        <button class="delete" aria-label="close">
        </button>
    </header>
    <section class="modal-card-body">

        @if ( count($gallery) > 0 )
            
            @foreach ($gallery as $media)
            
                <img src="{{asset($media->getUrl())}}" alt="{{ $media->name }}" img-thumbnail style="height: 50px; width:50px;">
            @endforeach

                
        @else
                <p>{{ __('There is no media') }}</p>
        @endif

    </section>

</div>