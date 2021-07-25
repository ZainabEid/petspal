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
                    <a href="#step-1" wire:click.prevent="back(1)" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                </div>

                <div class="multi-wizard-step">
                    <a href="#step-2" wire:click.prevent="firstStepSubmit" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                </div>

            </div>
        </div>



        <div class="row setup-content"  style=" {{ $currentStep != 1 ? 'display:none;' : '' }}" id="step-1">
            <div class="col-md-12">
                <h3> Step 1</h3>
                {{-- Name --}}
                <div class="form-group mb-3">

                    {!! Form::label('name', __('User Name:'), ['class' => 'boldfont']) !!}
                    {!! Form::text('name', null, ['wire:model' => 'name', 'class' => 'form-control', 'placeholder' => __('Enter user name'), 'required' => 'required']) !!}
                   
                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                {{-- Email --}}
                <div class="form-group mb-3">

                    {!! Form::label('email', __('Email:'), ['class' => 'boldfont']) !!}
                    {!! Form::email('email', null, ['wire:model' => 'email', 'class' => 'form-control', 'placeholder' => __('Enter user email'), 'required' => 'required']) !!}

                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                {{-- password --}}
                <div @isset($user) class="change-password-fields border p-2" style="display: none;" @endisset>

                    {{-- Password --}}
                    <div class="form-group mb-3">

                        {!! Form::label('password', __('password:'), ['class' => 'boldfont']) !!}
                        <input type="password" wire:model="password" , name="password" class="form-control"
                            placeholder="{{ __('Enter user passwprd') }}">
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    {{-- confirm password --}}
                    <div class="form-group mb-3">

                        {!! Form::label('password_confirmation', __('confirm password:'), ['class' => 'boldfont']) !!}
                        <input type="password" wire:model="password_confirmation" , name="password_confirmation"
                            class="form-control" placeholder="{{ __('Enter user passwprd') }}">
                        @error('password_confirmation') <span
                            class="text-danger error">{{ $message }}</span>@enderror
                    </div>


                </div>

                {{-- show password link only in edit --}}
                @isset($user)

                    <a href="#" id="chang-password">
                        {{ __('change password') }}
                    </a>
                @endisset
                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="firstStepSubmit"
                    type="button">Next</button>
            </div>
        </div>


        <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
            <div class="col-md-12">
                <h3> Step 2</h3>

                {{-- pet category --}}
                <div class="form-group">
                    {!! Form::label('pets_category', __('Pet Category:'), ['class' => 'boldfont']) !!}

                    <select name="pets_category_id" wire:model="pets_category_id" class="form-control">
                        <option value="">{{ __('Choose Category:') }}</option>

                        @foreach ($pets_categories as $pets_category)

                            <option value="{{ $pets_category->id }}">{{ $pets_category->name }}</option>

                        @endforeach

                    </select>

                    @error('pets_category_id') <span class="text-danger error">{{ $message }}</span>@enderror

                </div>

                {{-- account type --}}
                <div class="form-group row">
                    <div class="col-2">

                        {!! Form::label('is_adoption', __('Account Type:'), ['class' => 'boldfont']) !!}
                    </div>

                    <div class="col-2">

                        <input wire:model="is_adoption" value="1"  name="is_adoption" type="radio" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                        {{ __('Adaption')}}
                    </div>

                    <div class="col-2">

                        <input wire:model="is_adoption" value="0" name="is_adoption" type="radio" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                        {{ __('Normal')}}
                    </div>

                    @error('is_adoption') <span class="text-danger error">{{ $message }}</span>@enderror

                </div>

                <div class="card-footer">
                    {!! Form::button(__('Register'), ['wire:click.prevent' => 'secondStepSubmit', 'class' => 'btn btn-success']) !!}
                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                    wire:click="back(1)">Back</button>
                </div>

                {{-- <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button> --}}
                
                

            </div>
        </div>










        {!! Form::close() !!}

        {{-- end of tab content --}}



        {{-- end of card-body --}}




    </div>

    @push('scripts')
        <script type='text/javascript'>
            $(document).ready(function() {

                $('#chang-password').on('click', function(e) {
                    e.preventDefault();


                    if ($('.change-password-fields').css('display') == 'none') {

                        $('.change-password-fields').show();
                        $('#chang-password').html('hide');
                        return;
                    }

                    $('.change-password-fields').css('display', 'none');
                    $('#chang-password').html('change password');


                });
            });
        </script>
    @endpush

</div>
