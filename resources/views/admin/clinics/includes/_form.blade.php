<div class="card-body">
    @csrf
    <div class="inline-flex">

        {{-- Category --}}
        <div class="align-self-stretch p-2 m-1">

            {!! Form::label('category_id', __('Category:'), ['class' => 'boldfont']) !!}

            {{-- {!! Form::select("category_id", $categories, null, ['class'=>'form-select']) !!} --}}
            <select name="category_id" class="form-select" aria-label="select example">
                <option selected value="{{ null }}">
                    <label for="category_id" class="boldfont">{{ __('Choose Category') }}</label>
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (isset($clinic) && $clinic->category->id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Name --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('Name') }}</p>

            {{-- Name En --}}
            <div class="form-group mb-3">

                {!! Form::label('name', __('Name En:'), ['class' => 'boldfont']) !!}
                {!! Form::text('name[]', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) !!}

            </div>

            {{-- Name Ar --}}
            <div class="form-group mb-3">

                {!! Form::label('name', __('Name Ar:'), ['class' => 'boldfont']) !!}
                {!! Form::text('name[]', null, ['class' => 'form-control', 'placeholder' => __('Enter name'), 'required' => 'required']) !!}

            </div>


        </div>


        {{-- Description --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('Description') }}</p>


            {{-- description En --}}
            <div class="form-group mb-3">

                {!! Form::label('description', __('Description En:'), ['class' => 'boldfont']) !!}
                {!! Form::text('description[]', null, ['class' => 'form-control', 'placeholder' => __('Enter Desctiption'), 'required' => 'required']) !!}

            </div>

            {{-- description Ar --}}
            <div class="form-group mb-3">

                {!! Form::label('description', __('Description Ar:'), ['class' => 'boldfont']) !!}
                {!! Form::text('description[]', null, ['class' => 'form-control', 'placeholder' => __('Enter Desctiption'), 'required' => 'required']) !!}

            </div>

        </div>



        {{-- address --}}
        <div class="border align-self-stretch p-2 m-1">

            <p>{{ __('Address') }}</p>

            {{-- City --}}
            <div class="form-group mb-3">

                {!! Form::label('address', __('Address:'), ['class' => 'boldfont']) !!}
                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Enter clinic address'), 'required' => 'required']) !!}

            </div>

        </div>



        {{-- phones --}}
        <div class="border align-self-stretch p-2 m-1">

            <p>{{ __('Phones') }}</p>

            <div class="form-group d-flex flex-column  " id="all-phones">

                {!! Form::label('phones', 'Enter clinic phones', ['class' => 'boldfont']) !!}

                {{-- if clinic =>  edit existing clinic --}}
                @if (isset($clinic) && $clinic->phones->count() > 0)

                    @foreach ($clinic->phones as $index => $phone)

                        <div
                            class="form-group mb-3 phone-validation  @error('phones.' . $index) 'is-invalid' @enderror">
                            @if ($index == 0)

                                {{-- the first required phone --}}
                                {!! Form::text('phones[]', $phone, ['placeholder' => 'Enter clinic phone', 'class' => 'phone w-50 form-control d-inline-flex ']) !!}
                                @error('phones.' . $index)

                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <span style="cursor: pointer;" id="add-phone"
                                    data-url="{{ route('admin.clinics.add-phone') }}">
                                    <i class="align-middle" data-feather="plus"></i>
                                </span>

                            @else

                                {{-- show all extra phones --}}
                                @include('admin.clinics.includes._extra_phone')


                            @endif
                        </div>


                    @endforeach

                @else
                    {{-- create new clinic phones --}}

                    <div class="phone-validation form-group mb-3 @error('phones.0') 'has-error' @enderror">

                        {!! Form::text('phones[]', '', ['placeholder' => 'Enter clinic phone', 'class' => 'phone w-50 form-control d-inline-flex ']) !!}

                        <span style="cursor: pointer;" id="add-phone"
                            data-url="{{ route('admin.clinics.add-phone') }}">
                            <i class="align-middle" data-feather="plus"></i>
                        </span>
                        @error('phones.0') <span class="text-danger"> {{ $message }} </span> @enderror

                    </div>

                @endif
            </div>




        </div>

        {{-- Social --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('Social') }}</p>


            {{-- facebook --}}
            <div class="form-group mb-3">

                {!! Form::label('social[facebook]', __('Facebook Account:'), ['class' => 'boldfont']) !!}
                {!! Form::text('social[facebook]', isset($clinic) ? $clinic->facebook : null, ['class' => 'form-control', 'placeholder' => __('facebook link')]) !!}

            </div>


            {{-- tweeter --}}
            <div class="form-group mb-3">

                {!! Form::label('social[twitter]', __('Tweeter Account:'), ['class' => 'boldfont']) !!}
                {!! Form::text('social[twitter]', isset($clinic) ? $clinic->twitter : null, ['class' => 'form-control', 'placeholder' => __('twitter link')]) !!}

            </div>

            {{-- instagram --}}
            <div class="form-group mb-3">

                {!! Form::label('social[instagram]', __('Instagram Account:'), ['class' => 'boldfont']) !!}
                {!! Form::text('social[instagram]', isset($clinic) ? $clinic->instagram : null, ['class' => 'form-control', 'placeholder' => __('instagram link')]) !!}

            </div>




        </div>


        {{-- Working Hours --}}
        <div class="border align-self-stretch p-2 m-1">
            @include('admin.clinics.includes._working_hours')

        </div>


        {{-- exception dates - off days --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('OFF Days') }}</p>



            <a href="#" id="add-off-day" data-url="{{ route('admin.clinics.add-off-day') }}">
                {{ __('add new off-day') }}
            </a>

            <div id="off-days">

                {{-- js : adding new off day fields --}}
            </div>


        </div>

        {{-- Gallery --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('Gallery') }}</p>


            <div class="form-group mb-3">

                {!! Form::label('medias', __('choose Photos:'), ['class' => 'boldfont']) !!}
                {!! Form::file('medias[]', ['id' => 'photo-uploader', 'class' => 'photo-uploader', 'multiple' => true]) !!}
                <span class="text-danger" id="photo_error"></span>

                {{-- Gallery preview --}}
                <div class="gallery d-flex">
                    @if (isset($clinic))
                        @foreach ($clinic->gallery() as $media)

                            <div class="image-wrapper">

                                <img src="{{ asset($media->getUrl()) }}" alt="{{ $media->name }}"
                                    class="img-thumbnail" style="height: 50px; width:50px;">

                                <button class="delete delete-image" aria-label="close">x</button>

                            </div>
                        @endforeach
                    @else

                        {{-- js: append images here --}}

                    @endif
                </div>


            </div>

        </div>


    </div>



</div>
{{-- end of card-body --}}

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            /* Working Hours Table */

            // on page load handle working-hours table for edit
            $(function() {

                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', ];

                $.each(days, function(i, day) {
                    var count = $('#working-hours-table tr.' + day).length;
                    $('.dayname-' + day).attr('rowspan', count);
                });
            });


            //handle checkebox
            $('body').on('change', '.checked-day', function(e) {
                e.preventDefault();

                var checked = $(this).prop('checked');

                if (!checked) {

                    var day = $(this).data('day');

                    $('tr.' + day).find('.open-at,.close-at,.add-work-period ').attr('disabled', true);
                    $(this).closest('tr').find('.add-work-period ')
                        .addClass('text-secondary disabled')
                        .css({
                            'cursor': ''
                        });
                    $('table').children('tr .' + day + ':not(:first)').remove();

                } else {

                    $(this).closest('tr').find('.open-at,.close-at,.add-work-period ').attr('disabled',
                        false);
                    $(this).closest('tr').find('.add-work-period ')
                        .removeClass('text-secondary disabled')
                        .css({
                            'cursor': 'prointer'
                        });
                }

            });


            // add extra period
            $('body').on('click', '.add-work-period', function(e) {
                e.preventDefault();

                // check if not disabled
                if (!$(this).hasClass('disabled')) {
                    var url = $(this).data('url');
                    var day = $(this).data('day');
                    var element = $(this);

                    // find the tr counts of same day
                    var period_index = $('#working-hours-table tr.' + day).length;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "get",
                        url: url,
                        data: {
                            day,
                            period_index
                        },
                        success: function(extra_period) {
                            $('#working-hours-table').find('tr.' + day).last().after(
                                extra_period);
                            $('#working-hours-table')
                                .find('tr.' + day + ' td.dayname-' + day)
                                .attr('rowspan', function(i, rs) {
                                    rs = parseInt(rs);
                                    return rs + 1;
                                });

                        }
                    });
                }



            }); // end of add period field


            // cancel the added extra period
            $('body').on('click', '.cancelPeriod', function(e) {
                e.preventDefault();
                var day = $(this).data('day');
                var period_index = $(this).data('period_index');


                // remove the row
                $('tr#' + day + period_index).remove();

                // decrement first cell (Day Name) rowspan
                $('#working-hours-table')
                    .find('tr.' + day + ' td.dayname-' + day)
                    .attr('rowspan', function(i, rs) {
                        rs = parseInt(rs);
                        return rs - 1;
                    });
            }); // end of cancel period



            /* Off Days */

            // add off day
            $('body').on('click', '#add-off-day', function(e) {
                e.preventDefault();

                var url = $(this).data('url');

                // find the off days counts 
                var off_day_index = $('#off-days').children().length;
                console.log(off_day_index);

                $.ajax({
                    url: url,
                    data: {
                        off_day_index
                    },
                    success: function(new_off_day) {
                        $('#off-days').append(new_off_day);
                    }
                });

            }); // end of new off day


            // cancel the added off day period
            $('body').on('click', '.cancel-off-day', function(e) {
                e.preventDefault();

                $(this).closest('div.off-day').remove();


            }); // end of cancel off day




            /* add multi phones functions */

            // added extra phones
            $('body').on('click', '#add-phone', function(e) {
                e.preventDefault();

                var url = $(this).data('url');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(extra_phone) {

                        $('#all-phones').append(extra_phone);
                    }
                });

            }); // end of add phone field

            // delete this extra phone
            $('body').on('click', '.cancelPhone', function() {
                $(this).parent('div .extra-phones').remove();
            }); // end of cancel phone



            // preview uploaded photo when new photo is uploaded
            $('body').on('change', '#photo-uploader', function() {
                imagesPreview($('#photo-uploader')[0], 'div.gallery');

            });


            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var html = `
                            <div class="image-wrapper">

                                <img src="${event.target.result}"
                                    class="img-thumbnail" style="height: 50px; width:50px;">

                                <button class="delete delete-image" aria-label="close"></button>

                            </div>
                            `
                            $(placeToInsertImagePreview).append(html);

                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };


            $('body').on('click', '.delete-image', function(e) {
                e.preventDefault();

                $(this).closest('div.image-wrapper').remove;

            });
        });
    </script>
@endpush
