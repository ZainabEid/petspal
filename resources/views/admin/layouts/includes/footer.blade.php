<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
        <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="{{ route('admin.dashboard') }}" target="_blank"><strong>PetsPals
                            Demo</strong></a> &copy;
                </p>
                </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('admin.support') }}" target="_blank">{{ __('Support') }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('admin.about') }}" target="_blank">{{ __('About') }}</a>
                    </li>
                    {{-- <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('admin.privace') }}" target="_blank">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('admin.terms') }}" target="_blank">Terms</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>