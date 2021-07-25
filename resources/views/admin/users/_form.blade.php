<div class="card-body">

    {{-- Name --}}
    <div class="form-group mb-3">
        
        {!! Form::label('name', __('User Name:'), ['class' => 'boldfont']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter user name'), 'required' => 'required']) !!}

    </div>

    {{-- Email --}}
    <div class="form-group mb-3">

        {!! Form::label('email', __('Email:'), ['class' => 'boldfont']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter user email'), 'required' => 'required']) !!}

    </div>

    {{-- password  --}}
    <div @isset($user) class="change-password-fields border p-2" style="display: none;" @endisset >
        
        {{-- Password --}}
        <div class="form-group mb-3">
            
            {!! Form::label('password', __('password:'), ['class' => 'boldfont']) !!}
            <input type="password" name="password" class="form-control" placeholder="{{ __('Enter user passwprd') }}" >
            
        </div>
        
        {{-- confirm password --}}
        <div class="form-group mb-3">
            
            {!! Form::label('password_confirmation', __('confirm password:'), ['class' => 'boldfont']) !!}
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Enter user passwprd') }}" >

        </div>


    </div>
        
    {{-- show password link only in edit --}}
    @isset($user)
        
        <a href="#" id="chang-password"> 
            {{ __('change password') }}
        </a>
    @endisset
   
    
   
    {{-- end of tab content --}}



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
