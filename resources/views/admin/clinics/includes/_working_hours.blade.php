<p>{{ __('Working Hours') }}</p>

<table id="working-hours-table" class="table table-bordered table-hover my-0">

    <thead style="height: 2px; line-height: 2px;">
        <tr>
            <th style="text-align:center; vertical-align: center; " rowspan="2" ><label class="boldfont" >{{ __('Day') }}</label></th>
            <th style="text-align:center; vertical-align: center; " colspan="2" class="boldfont">{{ __('Periods') }}</th>
            <th style="text-align:center; vertical-align: center; " rowspan="2" class="boldfont">{{ __('Manage') }}</th>
        </tr>
        <tr>
            <th style="text-align:center; vertical-align: center ;">{{ __('Start Time') }}</th>
            <th style="text-align:center; vertical-align: center ;">{{ __('End Time') }}</th>
        </tr>
    </thead>

    <tbody>


        {{-- if clinic =>  edit existing clinic --}}
        {{-- ---------------------------------- --}}
        @if (isset($clinic))

            @foreach ($clinic->workingDays as $workingDay)

                @php
                    $day = $workingDay->day;
                    $index = 0;
                @endphp

                {{-- the first  period row --}}
                <tr class="{{ $day }}" id="{{ $day }}{{ $index }}">

                    {{-- Day Name --}}
                    <td rowspan="1" class="dayname-{{ $day }}"
                        style="text-align:center; vertical-align: center;">

                        <label class="form-check">

                            <input class="form-check-input checked-day" checked type="checkbox" name="days[]"
                                value="{{ $day }}" data-day="{{ $day }}">

                            <span class="form-check-label">{{ $day }}</span>

                        </label>
                    </td>


                    {{-- start time --}}
                    <td style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            {!! Form::time('workDays[' . $day . '][periods' . $index . '][open_at]', '08:00', ['class' => 'form-control w-50 d-inline-flex open-at']) !!}

                        </div>

                    </td>

                    {{-- end time --}}
                    <td class="end-time" style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            {!! Form::time('workDays[' . $day . '][periods' . $index . '][close_at]', '17:00', ['class' => 'form-control w-50 d-inline-flex close-at']) !!}

                        </div>

                    </td>

                    {{-- add period --}}
                    <td style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            <span style="cursor: pointer;" class="add-work-period "
                                data-url="{{ route('admin.clinics.add-work-period') }}"
                                data-day="{{ $day }}">
                                <i class="align-middle" data-feather="plus"></i>
                            </span>


                        </div>

                    </td>


                </tr>



                {{-- show all extra periods --}}
                @foreach ($workingDay->periods as $period_index => $period)

                    @if ($period_index != 0)

                        @include('admin.clinics.includes._extra_period')

                    @endif

                @endforeach


            @endforeach

        @else {{-- create new clinic working hours --}}
            {{-- ---------------------------------- --}}


            @foreach (get_days() as $day)

                @php
                    $index = 0;
                @endphp

                {{-- period row --}}
                <tr class="{{ $day }}" id="{{ $day }}{{ $index }}">


                    {{-- Day Name --}}
                    <td rowspan="1" class="dayname-{{ $day }}"
                        style="text-align:center; vertical-align: center;">

                        <label class="form-check">

                            <input class="form-check-input checked-day" checked type="checkbox" name="days[]"
                                value="{{ $day }}" data-day="{{ $day }}">

                            <span class="form-check-label">{{ $day }}</span>

                        </label>
                    </td>


                    {{-- start time --}}
                    <td style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            {!! Form::time('workDays[' . $day . '][periods' . $index . '][open_at]', '08:00', ['class' => 'form-control w-50 d-inline-flex open-at']) !!}

                        </div>

                    </td>

                    {{-- end time --}}
                    <td class="end-time" style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            {!! Form::time('workDays[' . $day . '][periods' . $index . '][close_at]', '17:00', ['class' => 'form-control w-50 d-inline-flex close-at']) !!}

                        </div>

                    </td>

                    {{-- add period --}}
                    <td style="text-align:center; vertical-align: center;">

                        <div class="form-group mb-3">

                            <span style="cursor: pointer;" class="add-work-period"
                                data-url="{{ route('admin.clinics.add-work-period') }}"
                                data-day="{{ $day }}">
                                <i class="align-middle" data-feather="plus"></i>
                            </span>


                        </div>

                    </td>


                </tr>

            @endforeach

        @endif



    </tbody>
</table>
