<div class="card-body">

    {{-- Name --}}
    <div class="form-group mb-3">
        
        {!! Form::label('name', __('Admin Name:'), ['class' => 'boldfont']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter admin name'), 'required' => 'required']) !!}

    </div>

    {{-- Email --}}
    <div class="form-group mb-3">

        {!! Form::label('email', __('Email:'), ['class' => 'boldfont']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter admin email'), 'required' => 'required']) !!}

    </div>

    {{-- password  --}}
    <div @isset($admin) class="change-password-fields border p-2" style="display: none;" @endisset >
        
        {{-- Password --}}
        <div class="form-group mb-3">
            
            {!! Form::label('password', __('password:'), ['class' => 'boldfont']) !!}
            <input type="password" name="password" class="form-control" placeholder="{{ __('Enter admin passwprd') }}" >
            
        </div>
        
        {{-- confirm password --}}
        <div class="form-group mb-3">
            
            {!! Form::label('password_confirmation', __('confirm password:'), ['class' => 'boldfont']) !!}
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Enter admin passwprd') }}" >

        </div>


    </div>
        
    {{-- show password link only in edit --}}
    @isset($admin)
        
        <a href="#" id="chang-password"> 
            {{ __('change password') }}
        </a>
    @endisset
   
    
    {{-- permision assignment --}}

    <div class="form-group">

        {!! Form::label('roles', __('roles:'), ['class' => 'boldfont']) !!}

        {!! Form::select('role', $roles ,null, ['class' => 'form-select mb-3']) !!}


    </div>

    {{-- end of tab content --}}

    {{-- End of permision assignment --}}


    {{-- end of card-body --}}




</div>

@push('scripts')
    <script type= 'text/javascript'>
        $(document).ready(function () {
            
            $('#chang-password').on('click',  function (e) {
                e.preventDefault();
                

                if( $('.change-password-fields').css('display') == 'none'){

                    $('.change-password-fields').show();
                    $('#chang-password').html('hide');
                    return;
                }

                $('.change-password-fields').css('display','none');
                $('#chang-password').html('change password');
                
                
            });
        });

    </script>
@endpush
