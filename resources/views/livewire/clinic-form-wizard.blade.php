<div>

    @if (!empty($successMsg))
        <div class="text-success">
            {{ $successMsg }}
        </div>
    @endif


    <!-- form start -->
    {!! Form::open(['route' => 'admin.users.store', 'role' => 'form']) !!}

    <div class="card-body">

        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">

                <div class="multi-wizard-step">
                    <a href="#step-1" wire:click.prevent="back(1)"
                        class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                </div>

                <div class="multi-wizard-step">
                    <a href="#step-2" wire:click.prevent="firstStepSubmit"
                        class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                </div>

            </div>
        </div>



        <div class="row setup-content" style=" {{ $currentStep != 1 ? 'display:none;' : '' }}" id="step-1">
            <div class="col-md-12">
                <h3> {{ __('Clinic details') }}</h3>


                {{-- Category --}}
                <div class="align-self-stretch p-2 m-1">

                    {!! Form::label('category_id', __('Category:'), ['class' => 'boldfont']) !!}

                    {{-- {!! Form::select("category_id", $categories, null, ['class'=>'form-select']) !!} --}}
                    <select wire:model="category_id" name="category_id" class="form-select" aria-label="select example">
                        <option selected value="{{ null }}">
                            <label for="category_id" class="boldfont">{{ __('Choose Category') }}</label>
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (isset($clinic) && $clinic->category->id == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>


                {{-- name & description in English --}}
                <div class="border align-self-stretch p-2 m-1">
                    <p>{{ __('English') }}</p>

                    {{-- Name En --}}
                    <div class="form-group mb-3">

                        {!! Form::label('name', __('Name En:'), ['class' => 'boldfont']) !!}
                        <input wire:model="name.0" type="text" name="" id="" placeholder="Enter name:"
                            class="form-control">

                    </div>

                    {{-- description En --}}
                    <div class="form-group mb-3">

                        {!! Form::label('description', __('Description En:'), ['class' => 'boldfont']) !!}
                        <input wire:model="description.0" type="text" name="description[]" id=""
                            placeholder="Enter Desctiption:" class="form-control">


                    </div>


                </div>


                {{-- name & description in Arabic --}}
                <div class="border align-self-stretch p-2 m-1">
                    <p>{{ __('Arabic') }}</p>


                    {{-- Name Ar --}}
                    <div class="form-group mb-3">

                        {!! Form::label('name', __('Name Ar:'), ['class' => 'boldfont']) !!}
                        <input wire:model="name.1" type="text" name="name[]" id="" placeholder="Enter name:"
                            class="form-control">


                    </div>

                    {{-- description Ar --}}
                    <div class="form-group mb-3">

                        {!! Form::label('description', __('Description Ar:'), ['class' => 'boldfont']) !!}
                        <input wire:model="description.1    " type="text" name="description[]" id=""
                            placeholder="Enter Desctiption:" class="form-control">


                    </div>

                </div>



                {{-- address --}}
                <div class="border align-self-stretch p-2 m-1">

                    <p>{{ __('Address') }}</p>

                    {{-- City --}}
                    <div class="form-group mb-3">

                        {!! Form::label('address', __('Address:'), ['class' => 'boldfont']) !!}

                        <input wire:model="address" type="text" name="address" id="" placeholder="Enter clinic address:"
                            class="form-control">

                    </div>

                </div>



                {{-- phones --}}
                <div class="border align-self-stretch p-2 m-1">

                    <p>{{ __('Phones') }}</p>

                    <div class="form-group d-flex flex-column  " id="all-phones">

                        {!! Form::label('phones', 'Enter clinic phones', ['class' => 'boldfont']) !!}

                        
                        {{-- create new clinic phones --}}
                        <div class="phone-validation form-group mb-3 @error('phones.0') 'has-error' @enderror">

                            <input wire:model="phones.0" type="text" name="phones[]" id=""
                                placeholder="Enter clinic phone:" class="form-control phone w-50 d-inline-flex">

                            {{-- add phone button --}}
                            <span wire:click.prevent="add( {{ $i }} )"  style="cursor: pointer;" >
                                <i class="align-middle" data-feather="plus"></i>
                            </span>

                            @error('phones.0') <span class="text-danger"> {{ $message }} </span> @enderror

                        </div>


                        @foreach ($phonesInput as $key => $value)

                            <div class="form-group mb-3 phone-validation  @error('phones.' . $value) 'is-invalid' @enderror">
                                <div class="extra-phones form-group mb-3">

                                    <input wire:model="{{ 'phones.' . $value }}" type="text" name="phones[]" id=""
                                    placeholder="Enter extra phone:" class="form-control phone w-50 d-inline-flex">

                                    @error('phone.' . $value) <span class="text-danger">  {{ $message }}  </span>  @enderror
                                  
                                    
                                    <span style="cursor: pointer;" class=" text-danger cancelPhone ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                
                                    </span>
                                </div>
                            </div>

                        @endforeach
                    </div>

                </div>




            </div>

            {{-- Social --}}
            <div class="border align-self-stretch p-2 m-1">
                <p>{{ __('Social') }}</p>


                {{-- facebook --}}
                <div class="form-group mb-3">

                    {!! Form::label('social[facebook]', __('Facebook Account:'), ['class' => 'boldfont']) !!}
                    <input wire:model="social.facebook" type="text" name="social[facebook]" id=""
                        placeholder="facebook link:" class="form-control">

                </div>


                {{-- tweeter --}}
                <div class="form-group mb-3">

                    {!! Form::label('social[twitter]', __('Tweeter Account:'), ['class' => 'boldfont']) !!}
                    <input wire:model="social.twitter" type="text" name="social[twitter]" id=""
                        placeholder="twitter link:" class="form-control">

                </div>

                {{-- instagram --}}
                <div class="form-group mb-3">

                    {!! Form::label('social[instagram]', __('Instagram Account:'), ['class' => 'boldfont']) !!}
                    <input wire:model="social.instagram" type="text" name="social[instagram]" id=""
                        placeholder="instagram link:" class="form-control">

                </div>




            </div>





            <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="firstStepSubmit"
                type="button">{{ __('Next') }}</button>
        </div>
    </div>


    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="col-md-12">
            <h3> {{ __('Working Time') }}</h3>




            {{-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button> --}}



        </div>
    </div>










    {!! Form::close() !!}

    {{-- end of tab content --}}



    {{-- end of card-body --}}




</div>


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

</div>
