<div class="sidebar container-fluid p-0 py-5 position-relative bg-white shadow-sm">
    <div class="pt-5 text-center">
        <span class="redhat med-text text-muted">Welcome,</span><br>
        <h4 class="redhat text-purple spacing-1 pt-2"><b>{{ $firstname }} !</b></h4>
        @if ($photo == null)
            <img src="{{ asset('img/profile/default-photo.png') }}" alt="" width="120px"
                class="pt-2 rounded-circle">
        @else
            <img src="{{ asset($photo) }}" alt="" width="120px" class="pt-2 rounded-circle">
        @endif

        <div class="pt-4 redhat text-start">
            @if($role == 2)
                <ul class="list-group border-0">
                    <li class="px-4 list-group-item border-0 rounded-0 text-muted @if (Request::is('dashboard')) active @endif"
                        aria-current="true" onclick="window.location = '{{ route('admin_dashboard') }}'">
                        @if (Request::is('dashboard'))
                            <img src="{{ asset('img/profileicons/home_active.png') }}" alt="home" width="15px"
                                class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/home_inactive.png') }}" alt="home" width="15px"
                                class="me-3">
                        @endif
                        Home
                    </li>
                    <li class="px-4 list-group-item border-0 text-muted @if (Request::is('lab_result')) active @endif"
                        onclick="window.location = '{{ route('admin_lab_result') }}'">
                        @if (Request::is('lab_result'))
                            <img src="{{ asset('img/profileicons/labresults_active.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/labresults_inactive.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @endif
                        Lab Results
                    </li>
                    <li class="px-4 list-group-item border-0 text-muted @if (Request::is('profile_management')) active @endif"
                        onclick="window.location = '{{ route('profile_management') }}'">
                        @if (Request::is('lab_result'))
                            <img src="{{ asset('img/profileicons/profile_active.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/profile_inactive.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @endif
                        Profile
                    </li>
                    <li class="px-4 list-group-item border-0 rounded-0 text-muted" data-bs-toggle="modal"
                        data-bs-target="#signOutModal">
                        @if (Request::is('signout'))
                            <img src="{{ asset('img/profileicons/signout_active.png') }}" alt="sign out" width="15px"
                                class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/signout_inactive.png') }}" alt="sign out"
                                width="15px" class="me-3">
                        @endif
                        Sign Out
                    </li>
                </ul>
            @elseif($role == 3 || $role == 4)
                <ul class="list-group border-0">
                    <li class="px-4 list-group-item border-0 rounded-0 text-muted @if (Request::is('dashboard')) active @endif"
                        aria-current="true" onclick="window.location = '{{ route('admin_dashboard') }}'">
                        @if (Request::is('dashboard'))
                            <img src="{{ asset('img/profileicons/home_active.png') }}" alt="home" width="15px"
                                class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/home_inactive.png') }}" alt="home"
                                width="15px" class="me-3">
                        @endif
                        Home
                    </li>
                    <li class="px-4 list-group-item border-0 text-muted @if (Request::is('lab_result')) active @endif"
                        onclick="window.location = '{{ route('admin_lab_result') }}'">
                        @if (Request::is('lab_result'))
                            <img src="{{ asset('img/profileicons/labresults_active.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/labresults_inactive.png') }}" alt="lab results"
                                width="15px" class="me-3">
                        @endif
                        Lab Results
                    </li>
                    <li class="px-4 list-group-item border-0 text-muted @if (Request::is('user_management')) active @endif"
                        onclick="window.location = '{{ route('user_management') }}'">
                        @if (Request::is('user_management'))
                            <img src="{{ asset('img/profileicons/recommendations_active.png') }}"
                                alt="user_management" width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/recommendations_inactive.png') }}"
                                alt="user_management" width="15px" class="me-3">
                        @endif
                        User
                    </li>
                    <li class="px-4 list-group-item border-0 text-muted @if (Request::is('profile_management')) active @endif"
                        onclick="window.location = '{{ route('profile_management') }}'">
                        @if (Request::is('profile_management'))
                            <img src="{{ asset('img/profileicons/profile_active.png') }}" alt="profile"
                                width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/profile_inactive.png') }}" alt="profile"
                                width="15px" class="me-3">
                        @endif
                        Profile
                    </li>
                    @if($role == 4)
                        <li class="px-4 list-group-item border-0 text-muted @if (Request::is('log_management')) active @endif"
                            onclick="window.location = '{{ route('log_management') }}'">
                            @if (Request::is('log_management'))
                                <img src="{{ asset('img/profileicons/profile_active.png') }}" alt="log management"
                                    width="15px" class="me-3">
                            @else
                                <img src="{{ asset('img/profileicons/profile_inactive.png') }}" alt="log management"
                                    width="15px" class="me-3">
                            @endif
                            Log Management
                        </li>
                    @endif
                    <li class="px-4 list-group-item border-0 rounded-0 text-muted" data-bs-toggle="modal"
                        data-bs-target="#signOutModal">
                        @if (Request::is('signout'))
                            <img src="{{ asset('img/profileicons/signout_active.png') }}" alt="sign out"
                                width="15px" class="me-3">
                        @else
                            <img src="{{ asset('img/profileicons/signout_inactive.png') }}" alt="sign out"
                                width="15px" class="me-3">
                        @endif
                        Sign Out
                    </li>
                </ul>
            @endif
        </div>

        <div class="position-absolute px-4 text-start" style="bottom: 10px; width: 100%">
            <p class="redhat small-text text-muted">
                Elevate your health with MPower's expert guidances and personalized recommendations.
            </p>
        </div>
    </div>
</div>
