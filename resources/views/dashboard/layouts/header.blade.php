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
                
                <li class="dropdown topbar-dropdown">
                    <a class="nav-link dropdown-toggle me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <iconify-icon icon="flag:us-4x3" class="fs-20 align-middle topbar-button" id="selected-language-image"></iconify-icon>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="en">
                            <img src="assets/images/flags/us.svg" alt="user-image" class="me-1 rounded" height="18" data-translator-image=""> <span class="align-middle">English</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="hi">
                            <img src="assets/images/flags/in.svg" alt="user-image" class="me-1 rounded" height="18" data-translator-image=""> <span class="align-middle">Hindi</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/de.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/ca.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Canada</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/au.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Australia</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/ru.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Russian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/si.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Italian</span>
                        </a>
                    </div>
                </li>

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
                        <span class="badge bg-danger rounded-circle noti-icon-badge">5</span>
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
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notification-dropdown-item notify-item text-muted border-bottom">
                                <div class="d-flex align-content-start">
                                    <div class="notify-icon bg-light">
                                        <iconify-icon icon="tabler:bell-ringing" class="fs-18 text-primary align-middle"></iconify-icon>
                                    </div>

                                    <div>
                                        <p class="notify-details fw-normal">
                                            <span class="fs-14 text-dark">System Alert:</span> Server CPU usage exceeded <br> 85% on Node #3.
                                        </p>
                                        <p class="mb-0 user-msg">
                                            <small class="fs-14">Just now</small>
                                        </p>
                                    </div>

                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notification-dropdown-item notify-item text-muted border-bottom">
                                <div class="d-flex align-content-start">
                                    <div class="notify-icon bg-light">
                                        <iconify-icon icon="emojione:rocket" class="fs-18 text-primary align-middle"></iconify-icon>
                                    </div>

                                    <div>
                                        <p class="notify-details fw-normal">
                                            <span class="fs-14 text-dark">Update:</span> New product category <br> "Smart Wearables" has been added.
                                        </p>
                                        <p class="mb-0 user-msg">
                                            <small class="fs-14">5 min ago</small>
                                        </p>
                                    </div>

                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notification-dropdown-item notify-item text-muted border-bottom">
                                <div class="d-flex align-content-start">
                                    <div class="notify-icon bg-light">
                                        <iconify-icon icon="tabler:mail" class="fs-18 text-primary align-middle"></iconify-icon>
                                    </div>

                                    <div>
                                        <p class="notify-details fw-normal">
                                            <span class="fs-14 text-dark">Message:</span> You have 3 unread customer <br> support tickets.
                                        </p>
                                        <p class="mb-0 user-msg">
                                            <small class="fs-14">10 min ago</small>
                                        </p>
                                    </div>

                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notification-dropdown-item notify-item text-muted border-bottom">
                                <div class="d-flex align-content-start">
                                    <div class="notify-icon bg-light">
                                        <iconify-icon icon="tabler:shopping-cart" class="fs-18 text-primary align-middle"></iconify-icon>
                                    </div>

                                    <div>
                                        <p class="notify-details fw-normal">
                                            <span class="fs-14 text-dark">Sales Update:</span> New order #1023 has been <br> placed successfully.
                                        </p>
                                        <p class="mb-0 user-msg">
                                            <small class="fs-14">15 min ago</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-dark notify-item notify-all bg-light">View all
                            <i class="fe-arrow-right"></i>
                        </a>
                        
                    </div>
                </li>

                <!-- User Dropdown -->
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/users/user-13.jpg" alt="user-image" class="" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="pages-profile.html" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:user-square-rounded" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="page-profile.html" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:settings" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>Setting</span>
                        </a>

                        <!-- item-->
                        <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:shield-lock" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="auth-logout.html" class="dropdown-item notify-item">
                            <iconify-icon icon="tabler:logout" class="fs-18 align-middle" id="selected-language-image"></iconify-icon>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<header class="navbar navbar-dark navbar-expand sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/dashboard">INNA &mdash; BioRepository</a>
    <button 
        class="btn btn-link text-white btn-sm order-1 order-lg-0 me-4 me-lg-0 d-block d-sm-block d-md-none" 
        data-bs-toggle="collapse" 
        data-bs-target="#sidebarMenu" 
        aria-controls="sidebarMenu" 
        aria-expanded="false" 
        aria-label="Toggle navigation"> 
        <i class="bi bi-list"></i>
    </button>
    
    {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="dropdown ms-auto me-0 me-md-3 my-2 my-md-0">
        <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if($unseen)
            <span class="position-absolute top-10 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New Alert</span>
            </span>
            @endif
            <i class="bi bi-person"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
                <a class="dropdown-item" href="{{route('users.profile')}}"><i class="bi bi-gear"></i> Profile</a>
            </li>
            <li>
                <a class="dropdown-item position-relative" data-bs-toggle="offcanvas" href="#notificationOffCanvas" role="button" aria-controls="notificationOffCanvas">
                    @if($unseen)
                    <span class="position-absolute top-10 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New Alert</span>
                    </span>
                    @endif
                    <i class="bi bi-bell"></i> 
                    Notification 
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" role="button" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
    
</header>