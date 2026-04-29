<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button type="button" class="button-toggle-menu nav-link">                    
                        <iconify-icon icon="tabler:align-left" class="fs-20 align-middle text-dark topbar-button"></iconify-icon>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <form class="app-search d-none d-md-block me-auto">
                        <div class="position-relative topbar-search">
                            <input type="text" class="form-control ps-4 rounded-2" placeholder="Search..." />
                            <i class="mdi mdi-magnify fs-16 position-absolute text-dark top-50 translate-middle-y ms-2"></i>
                        </div>
                    </form>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <!-- Button Trigger Customizer Offcanvas -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <iconify-icon icon="tabler:maximize" class="fs-20 align-middle text-dark topbar-button fullscreen noti-icon"></iconify-icon>
                    </button>
                </li>

                <!-- Light/Dark Mode Button Themes -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <div class="topbar-button">
                            <iconify-icon icon="tabler:moon" class="fs-20 text-dark align-middle dark-mode"></iconify-icon>
                            <iconify-icon icon="tabler:sun-high" class="fs-20 text-dark align-middle light-mode"></iconify-icon>
                        </div>
                    </button>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <iconify-icon icon="tabler:bell" class="fs-20 text-dark align-middle topbar-button"></iconify-icon>
                        @if($unseen)
                            <span class="badge bg-danger rounded-circle noti-icon-badge">*</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-xl">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 fs-16">
                                <span class="float-end">
                                    <a href="" class="text-dark"><small><iconify-icon icon="tabler:x" class="fs-18 text-dark align-middle"></iconify-icon></small></a>
                                </span>
                                Notification
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar>
                            @foreach ($notifications as $notification)
                            <a onclick="return markReadNotification(this)" data-id="{{$notification->id}}" data-target="/dashboard/{{ $notification->action === 'assignedToCurator' ? 'curator/' : '' }}{{ lcfirst($notification->type) }}s/{{ $notification->item_id }}" href="#" class="dropdown-item notification-dropdown-item notify-item text-muted border-bottom {{ $notification->seen ? '' : 'unread' }}">
                                <div class="d-flex align-content-start">
                                    <div class="notify-icon bg-light">
                                        <iconify-icon icon="tabler:bell" class="fs-18 text-primary align-middle"></iconify-icon>
                                    </div>

                                    <div>
                                        @switch($notification->action)
                                            @case("approved")
                                                <p class="notify-details fw-normal">
                                                    <span class="fs-14 text-dark {{ !$notification->seen ? 'fw-bold' : 'text-muted' }}">Your {{ lcfirst($notification->type) }} has been approved.</span>
                                                </p>
                                                @break
                                            @case("returnedToSubmitter")
                                                <p class="notify-details fw-normal">
                                                    <span class="fs-14 text-dark {{ !$notification->seen ? 'fw-bold' : 'text-muted' }}">Your {{ lcfirst($notification->type) }} has been returned to you.</span>
                                                </p>
                                                @break
                                            @case("assignedToCurator")
                                                <p class="notify-details fw-normal">
                                                    <span class="fs-14 text-dark {{ !$notification->seen ? 'fw-bold' : 'text-muted' }}">{{ $notification->type }} assignment</span>
                                                </p>
                                                @break
                                            @case("rejected")
                                                <p class="notify-details fw-normal">
                                                    <span class="fs-14 text-dark {{ !$notification->seen ? 'fw-bold' : 'text-muted' }}">Sorry your {{ lcfirst($notification->type) }} has been rejected.</span>
                                                </p>
                                                @break
                                            @default
                                                <p class="notify-details fw-normal">
                                                    <span class="fs-14 text-dark {{ !$notification->seen ? 'fw-bold' : 'text-muted' }}">{{ $notification->action }}</span>
                                                </p>
                                        @endswitch

                                        <p class="mb-0 user-msg">
                                            <small class="fs-14 text-muted">{{ $notification->created_at->format('j F Y H:i') }}</small>
                                        </p>
                                    </div>

                                </div>
                            </a>
                            @endforeach
                        </div>

                        <!-- All-->
                        <a class="dropdown-item text-center text-dark notify-item notify-all bg-light" data-bs-toggle="offcanvas" href="#notificationOffCanvas" role="button" aria-controls="notificationOffCanvas">View all
                            <i class="fe-arrow-right"></i>
                        </a>
                        
                    </div>
                </li>

                @php
                    $userData = json_decode(auth()->user()->user_data);
                @endphp

                <!-- User Dropdown -->
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ $userData->userData->photo_url}}" onerror="this.onerror=null; this.src='/images/user.png';" alt="user-image" class="" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome, {{ strtok(Auth::user()->name, " ") }} !</h6>
                        </div>

                        <!-- item-->
                        <a href="{{route('users.profile')}}" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:user-square-rounded" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>Profile</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" role="button" class="dropdown-item notify-item">
                                <iconify-icon icon="tabler:logout" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>