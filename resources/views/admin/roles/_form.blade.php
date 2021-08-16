 <div class="card-body">
    <div class="form-group mb-3">

        {!! Form::label('name', 'Role Name:', ['class' => 'boldfont']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter the role name', 'required' => 'required']) !!}

    </div>

    {{-- permision assignment --}}
    
    <div class="form-group mb-0">
        
        {!! Form::label('permissions', 'Permissions:', ['class' => 'boldfont']) !!}
        
    </div>
    
    <div class="d-flex flex-wrap">

        @php
            $models = ['admin','role','clinic','clinicscategory','page','petscategory','user','account','post','comment']
        @endphp
        @foreach ($models as $index => $model)
        
            <div class="border align-self-stretch p-2 m-1">

                <span>{{ __($model) }}</span>

                @foreach (crud_maps() as $map)

                    <div class="form-check">

                        {!! Form::checkbox('permissions[]' , $map.'_'.$model, null, ['class' =>"form-check-input"]) !!}
                        {!! Form::label('checkbox', $map.' '.$model, ['class' => 'form-check-label']) !!}

                    </div>

                @endforeach

            </div>

        @endforeach


    </div>



    

 </div>
