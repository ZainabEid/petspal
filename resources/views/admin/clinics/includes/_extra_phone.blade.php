<div class="extra-phones form-group mb-3">

    {!! Form::text('phones[]', $phone ?? null, ['placeholder' => 'Enter extra phone', 'class' => 'phone  w-50 form-control d-inline-flex ']) !!}

    @isset($index)
        @error('phone.' . $index)
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
    @endisset
    
    <span style="cursor: pointer;" class=" text-danger cancelPhone ">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

        {{-- <i class="align-middle me-2" data-feather="X">x</i> --}}
    </span>
</div>
