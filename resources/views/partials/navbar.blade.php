<nav class="navbar navbar-expand-lg navbar-dark bg-brin">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">INNA &mdash; Bio Repository</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Home') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Bioproject') ? 'active' : '' }}" href="/bioprojects">BioProject</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'BioSample') ? 'active' : '' }}" href="/biosamples">BioSample</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'BioArchive') ? 'active' : '' }}" href="/bioarchives">BioArchive</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto ms-2 mb-lg-0">
                @auth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a></li>
                        <li>
                            <hr class="dropdowns-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

                @else

                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'Login') ? 'active' : '' }}" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>