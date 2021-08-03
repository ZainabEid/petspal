@extends('admin.layouts.app')

@section('content')

    <main class="content">

        <div class="card">
            <div class="card-header">
                {{-- page Header --}}
                <div class="d-flex justify-content-between mb-2 ">

                    <h1 class="h3 mb-3"><strong>{{ $page->name . ' ' . __('Page') }}</strong> </h1>

                </div>
            </div>
            <div class="card-body">




                {!! Form::model($page, ['id' => 'update-page-form', 'files' => true, 'route' => ['admin.pages.update', $page->id]]) !!}

                @csrf
                @method('PUT')

                {{-- // tab en tab ar --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="English-tab" data-bs-toggle="tab" data-bs-target="#English"
                            type="button" role="tab" aria-controls="English" aria-selected="true">English</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Arabic-tab" data-bs-toggle="tab" data-bs-target="#Arabic" type="button"
                            role="tab" aria-controls="Arabic" aria-selected="false">Arabic</button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    {{-- English tab --}}
                    <div class="tab-pane fade show active" id="English" role="tabpanel" aria-labelledby="English-tab">

                        {{-- inputs in english --}}
                        <div>
                            {{-- title --}}
                            <div class="form-group mb-3">

                                {!! Form::label('title', __('Page Title:'), ['class' => 'boldfont']) !!}
                                {!! Form::text('title[en]', $page->getTranslation('title', 'en'), ['class' => 'form-control', 'placeholder' => __('Enter Page title'), 'required' => 'required']) !!}

                                @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            {{-- image --}}
                            <div class="form-group mb-3">

                                {!! Form::label('image', __('Page Image'), ['class' => 'boldfont']) !!}
                                {!! Form::file('image', null, ['class' => 'form-control']) !!}

                                @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            {{-- body --}}
                            <div class="form-group mb-3">

                                {!! Form::label('body', __('Content:'), ['class' => 'boldfont']) !!}
                                {!! Form::textarea('body[en]', $page->getTranslation('body', 'en'), ['class' => 'ckeditor editor form-control', 'id' => 'editor1', 'placeholder' => __('Enter user body'), 'required' => 'required']) !!}

                                @error('body') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>


                    {{-- Arabic Tab --}}
                    <div class="tab-pane fade" id="Arabic" role="tabpanel" aria-labelledby="Arabic-tab">

                        {{-- inputs in arabic --}}
                        <div>
                            {{-- title --}}
                            <div class="form-group mb-3">

                                {!! Form::label('title', __('Page Title:'), ['class' => 'boldfont']) !!}
                                {!! Form::text('title[ar]', $page->getTranslation('title', 'ar'), ['class' => 'form-control', 'placeholder' => __('Enter Page title'), 'required' => 'required']) !!}

                                @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            {{-- image --}}
                            <div class="form-group mb-3">

                                {!! Form::label('image', __('Page Image'), ['class' => 'boldfont']) !!}
                                {!! Form::file('image', null, ['class' => 'form-control']) !!}

                                @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            {{-- body --}}
                            <div class="form-group mb-3">

                                {!! Form::label('body', __('Content:'), ['class' => 'boldfont']) !!}
                                {!! Form::textarea('body[ar]', $page->getTranslation('body', 'ar'), ['class' => 'ckeditor editor form-control', 'id' => 'editor2', 'placeholder' => __('Enter user body'), 'required' => 'required']) !!}
                                
                                @error('body') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>






                {!! Form::submit(__('Save changes'), ['class' => 'btn btn-success']) !!}


                {!! Form::close() !!}

            </div>
        </div>



    </main>

@endsection


@push('scripts')

    <!-- ck editor JS-->
   
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '.editor' ),{
                language: {
                    ui:"{{ app()->getLocale() }}",
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
 
   
@endpush
