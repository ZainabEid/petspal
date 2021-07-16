<div class="modal-card">
    <header class="modal-card-head">
        <p class="modal-card-title"> {{ __('Clinic Working Time') }}</p>
        <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
        @foreach ($working_days as $workingDay)

            <p> {{ $workingDay->day }}:
                @foreach ($workingDay->periods as $index => $period)
                    @if ($index != 0)
                        ,
                    @endif
                    {{ $period->open_at }}-{{ $period->close_at }}

                @endforeach

            </p>
        @endforeach
    </section>
    
</div>