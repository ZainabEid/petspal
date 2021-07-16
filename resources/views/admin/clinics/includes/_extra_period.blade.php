<tr class="{{ $day }}" id="{{ $day }}{{ $period_index }}">

    {{-- start time --}}
    <td style="text-align:center; vertical-align: center;">

        <div class="form-group mb-3">

            {!! Form::time('workDays['.$day.'][periods'.$period_index.'][open_at]', '08:00', ['class' => 'form-control w-50 d-inline-flex open-at']) !!}

        </div>

    </td>

    {{-- end time --}}
    <td style="text-align:center; vertical-align: center;">

        <div class="form-group mb-3">

            {!! Form::time('workDays['.$day.'][periods'.$period_index.'][close_at]', '17:00', ['class' => 'form-control w-50 d-inline-flex close-at']) !!}

        </div>

    </td>

    {{-- cancel period --}}
    <td style="text-align:center; vertical-align: center;">

        <div class="form-group mb-3">

            <span style="cursor: pointer;" class="  text-danger cancelPeriod " 
                data-day="{{ $day }}" 
                data-period_index="{{ $period_index }}"
                >
                
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>

        </div>

    </td>
        
</tr>
