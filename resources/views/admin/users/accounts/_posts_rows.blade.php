@if (isset($posts) && $posts->count() > 0)

  @foreach ($posts as $index => $post)

    {!! $index != 0 ? '<hr />' : '' !!}

    {{-- post component --}}
    <div class="d-flex align-items-start">
        <div class="flex-grow-1">

            {{-- post component --}}
          @include('admin.users.accounts._post')

        
        </div>
    </div>

  @endforeach
@endif

            