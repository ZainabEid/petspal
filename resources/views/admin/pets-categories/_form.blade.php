<div class="card-body">
 
    <div class="d-flex flex-nowrap">

        {{-- English --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('English') }}</p>


            {{-- Name En --}}
            <div class="form-group mb-3">
                    
                {!! Form::label('name', __('Category Name English:'), ['class' => 'boldfont']) !!}
                {!! Form::text('name[]', null, ['class' => 'form-control', 'placeholder' => __('Enter category name'), 'required' => 'required']) !!}

            </div>

            
            {{-- description En --}}
            <div class="form-group mb-3">
                
                {!! Form::label('name', __('Categpry Description English:'), ['class' => 'boldfont']) !!}
                {!! Form::text('description[]', null, ['class' => 'form-control', 'placeholder' => __('Enter Desctiption'), 'required' => 'required']) !!}

            </div>

        </div>


        {{-- Arabic --}}
        <div class="border align-self-stretch p-2 m-1">
            <p>{{ __('Arabic') }}</p>


            {{-- Name Ar --}}
            <div class="form-group mb-3">
                    
                {!! Form::label('name', __('Category Name Arabic:'), ['class' => 'boldfont']) !!}
                {!! Form::text('name[]', null, ['class' => 'form-control', 'placeholder' => __('Enter category name'), 'required' => 'required']) !!}

            </div>

            
            {{-- description Ar --}}
            <div class="form-group mb-3">
                
                {!! Form::label('name', __('Categpry Description Arabic:'), ['class' => 'boldfont']) !!}
                {!! Form::text('description[]', null, ['class' => 'form-control', 'placeholder' => __('Enter Desctiption'), 'required' => 'required']) !!}
                
            </div>

        </div>




    </div>


   
</div>
{{-- end of card-body --}}
