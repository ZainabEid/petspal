@extends('admin.layouts.app')

@section('content')

    <main class="content">


        {{-- page Header --}}
        <div class="d-flex justify-content-between mb-2 ">

            <h1 class="h3 mb-3"><strong>{{ $page->page . ' ' . __('Page') }}</strong> </h1>

            <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-info show-modal" style="cursor: pointer;">
                <i class=" text-info align-middle me-2" data-feather="edit"></i>
            </a>

        </div>

        {{-- Page Content --}}
        <div class="row">
            <div class="col-12  d-flex">

                <div class="card flex-fill">

                    <div class="card-header">

                        <h5 class="card-title mb-0">{{ $page->title }}</h5>

                    </div>


                    <div>
                        @if (isset($page->image))
                            <img src="{{ $page->image }}">
                        @endif
                    </div>


                    <div>
                        <p>{!! $page->body !!}</p>
                    </div>

                </div>

            </div>

        </div>






       

    </main>

@endsection

