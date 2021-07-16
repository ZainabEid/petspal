@extends('admin.layouts.app')

@section('content')


<main class="content">

  <div class="container-fluid p-0">

      <div class="d-flex justify-content-between mb-2 ">

          <h1 class="h3 mb-3"><strong>{{ __('Edit role') }}</strong> </h1>

      </div>

  
      <div class="row">
          <div class="col-12  d-flex">

              <div class="card flex-fill">

                <div class="card-header">

                    <h5 class="card-title mb-0">{{ __('Create New role') }}</h5>

                </div>


                 
                {!! Form::model( $role , ['route'=> ['admin.roles.update', $role->id ], 'role' => 'form', 'files' => true , 'method' => 'put']) !!}

                @include('admin.roles._form')

                <div class="card-footer">
                  {!! Form::submit('save', ['class' => 'btn btn-success']) !!}
              </div>
          

                {!! Form::close() !!}


              </div>
          
          


          </div>
      </div>
  </div>
</main>
  
    
@endsection