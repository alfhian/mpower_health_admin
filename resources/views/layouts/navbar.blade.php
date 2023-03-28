<section class="header w-100 bg-white fixed-top">
    <div class="container-fluid py-2 shadow-sm">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/') }}"><img src="{{ asset('img/mpower_text_logo.png') }}" alt="MPower Logo"
                            class="ms-5" width="150"></a>
                    <div class="d-flex align-items-center small-text roboto text-purple">
                        @if (Auth::check())
                            <button type="button"
                                class="btn btn-sm bg-purple redhat small-text text-white shadow rounded-pill spacing-1 me-2 py-2 px-5"
                                data-bs-toggle="modal" data-bs-target="#signOutModal">
                                <b>SIGN OUT</b>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
