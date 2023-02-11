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
                <a class="nav-link {{ Request::is('dashboard/biosamples*') ? 'active' : ''}}" href="/dashboard/biosamples">
                    <span data-feather="layers"></span>
                    My BioSample
                </a>
                <a class="nav-link  {{ Request::is('dashboard/bioarchives*') ? 'active' : ''}}" href="/dashboard/bioarchives">
                    <span data-feather="hard-drive"></span>
                    My BioArchive
                </a>
            </li>
        </ul>
        @canany(['isSuperAdmin','isAdmin'])
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : ''}}" aria-current="page" href="/dashboard/users">
                    <span data-feather="user-plus"></span>
                    User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/roles*') ? 'active' : ''}}" aria-current="page" href="/dashboard/roles">
                    <span data-feather="award"></span>
                    Role
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/organisms*') ? 'active' : ''}}" aria-current="page" href="/dashboard/organisms">
                    <span data-feather="grid"></span>
                    Organism
                </a>
            </li>
        </ul>
        @endcanany
        @cannot('isAuthor')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Curator</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/curator/bioprojects*') ? 'active' : ''}}" href="/dashboard/curator/bioprojects">
                    <span data-feather="list"></span>
                    BioProject
                </a>
                <a class="nav-link {{ Request::is('dashboard/curator/biosamples*') ? 'active' : ''}}" href="/dashboard/curator/biosamples">
                    <span data-feather="layers"></span>
                    BioSample
                </a>
                <a class="nav-link {{ Request::is('dashboard/curator/bioarchives*') ? 'active' : ''}}" href="/dashboard/curator/bioarchives">
                    <span data-feather="hard-drive"></span>
                    BioArchive
                </a>
            </li>
        </ul>
        @endcannot
    </div>
</nav>