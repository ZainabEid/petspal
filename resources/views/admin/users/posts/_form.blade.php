<div class="card-body">

     {{-- menue --}}
     <div class="float-start text-navy">

        <div class="account-avatar-overlay">
            <i onclick="document.getElementById('photo-uploader').click()" class="align-middle"
                data-feather="image"></i>

        </div>

        <div class="form-group mb-3">

            {!! Form::file('medias[]', ['id' => 'photo-uploader', 'class' => 'photo-uploader', 'multiple' => true, 'style' => 'display: none; ']) !!}
            <span class="text-danger" id="photo_error"></span>

            {{-- Gallery preview --}}
            
                @if (isset($posts))
                    @foreach ($posts->collection() as $media)

                        <div class="image-wrapper">

                            <iframe src="{{ asset($media->getUrl()) }}" frameborder="0" style="height: 100px; width:100px;"></iframe>

                            {{-- <img src="" alt="{{ $media->name }}"
                                class="img-thumbnail" style="height: 50px; width:50px;"> --}}

                            <button class="delete delete-image" aria-label="close">x</button>

                        </div>
                    @endforeach
                @else
                <div class="gallery d-flex">

                    {{-- js: append images here --}}

                </div>
                @endif


        </div>


        
    </div>

    {{-- body --}}
    <div class="form-group mb-3">

        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => __('write something'), 'required' => 'required']) !!}

    </div>
   


    {{-- end of card-body --}}




</div>

@push('scripts')
    <script type='text/javascript'>
        $(document).ready(function() {
            // preview uploaded photo when new photo is uploaded
            $('body').on('change', '#photo-uploader', function() {
                imagesPreview($('#photo-uploader')[0], 'div.gallery');

            });


            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    $(placeToInsertImagePreview).empty();

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var html = `
                            <div class="image-wrapper">

                                <iframe src="${event.target.result}" frameborder="1" ></iframe>
                                

                                <button class="delete delete-image" aria-label="close">x</button>

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
