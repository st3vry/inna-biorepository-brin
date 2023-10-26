<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="/images/inna-biorepo-red.png" alt="brand">
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{Request::is('/') ? 'active' : ''}} " href=" {{ str_contains($title, 'Bio') || str_contains($title, 'Under') ?  '/' : "#" }}">Home </a></li>
                @if(Request::is('bio*'))
                    <li><a class="nav-link {{Request::is('bioprojects*') ? 'active' : ''}}" href="/bioprojects">BioProject</a></li>
                    <li><a class="nav-link {{Request::is('biosamples*') ? 'active' : ''}}" href="/biosamples">BioSample</a></li>
                    <li><a class="nav-link {{Request::is('bioarchives*') ? 'active' : ''}}" href="/bioarchives">BioArchive</a></li>
                @elseif(Request::is('undev'))

                @else
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li class="dropdown">
                    <a href="#features">
                        <span>Collections</span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="/bioprojects">
                                <i class="bi bi-globe-asia-australia"></i>
                                 BioProject
                            </a>
                        </li>
                        <li>
                            <a href="/biosamples">
                                <i class="bi bi-gender-ambiguous"></i>
                                 BioSample
                            </a>
                        </li>
                        <li>
                            <a href="/bioarchives">
                                <i class="bi bi-box"></i>
                                 BioArchive
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                @endif

                @auth
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name}}
                    </a>
                    <ul>
                        <li><a href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a></li>
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
                    <a class="nav-link {{ ($title === 'Login') ? 'active' : '' }}" href="/login/sso"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                </li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header><!-- End Header -->
