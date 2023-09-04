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