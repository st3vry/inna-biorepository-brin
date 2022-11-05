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
    </div>
</nav>