@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
@endpush


{{-- modal --}}
<div class="modal" id="edit-modal">
    <div class="modal-background"></div>
    <div id="to-append">

        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title"> {{ __('Edit Account') }}</p>
                <button class="delete" aria-label="close">
                </button>
            </header>
            <section class="modal-card-body">
        
                {{-- Name --}}
                <div class="form-group mb-3">
        
                    {!! Form::label('name', __('Pet Name:'), ['class' => 'boldfont']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter pet name'), 'required' => 'required']) !!}
        
                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
        
                {{-- Email --}}
                <div class="form-group mb-3">
        
                    {!! Form::label('email', __('Email:'), ['class' => 'boldfont']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter user email'), 'required' => 'required']) !!}
        
                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
        
                {{-- pet category --}}
                <div class="form-group">
                    {!! Form::label('pets_category', __('Pet Category:'), ['class' => 'boldfont']) !!}
        
                    <select name="pets_category_id" class="form-control">
                        <option value="">{{ __('Choose Category:') }}</option>
        
                        @foreach ($pets_categories as $pets_category)
        
                            <option value="{{ $pets_category->id }}" @if ($account->category->id === $pets_category->id) selected @endif>
                                {{ $pets_category->name }}
                            </option>
        
                        @endforeach
        
                    </select>
        
                    @error('pets_category_id') <span class="text-danger error">{{ $message }}</span>@enderror
        
                </div>
        
                {{-- account type --}}
                <div class="form-group row">
                    <div class="col-3">
        
                        {!! Form::label('is_adoption', __('Account Type:'), ['class' => 'boldfont']) !!}
                    </div>
        
                    <div class="col-3">
        
                        <input value="1" name="is_adoption" type="radio" @if ($account->is_adoption == 1) checked @endif
                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                        {{ __('Adaption') }}
                    </div>
        
                    <div class="col-3">
        
                        <input value="0" name="is_adoption" type="radio" @if ($account->is_adoption == 0) checked @endif
                            class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                        {{ __('Normal') }}
                    </div>
        
                    @error('is_adoption') <span class="text-danger error">{{ $message }}</span>@enderror
        
                </div>
        
            </section>
        
            <footer class="modal-card-foot">
                <button onclick="document.getElementById('update-account-form').submit()"
                    class="button is-success">{{ __('Save changes') }}</button>
                <button aria-label="close" class="delete button">{{ __('Cancel') }}</button>
            </footer>
        
        </div>

    </div>
</div>
