<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/bioprojects*') ? 'active' : ''}}" href="/dashboard/bioprojects">
                    <span data-feather="list"></span>
                    My BioProject
                </a>
                <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    My BioSample
                </a>
                <a class="nav-link" href="#">
                    <span data-feather="hard-drive"></span>
                    My BioArchive
                </a>
            </li>
        </ul>
        @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/organisms*') ? 'active' : ''}}" aria-current="page" href="/dashboard/organisms">
                    <span data-feather="grid"></span>
                    Organism
                </a>
            </li>
        </ul>
        @endcan
    </div>
</nav>