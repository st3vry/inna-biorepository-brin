<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
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
                    <a class="nav-link {{ ($title === 'Bioproject') ? 'active' : '' }}" href="/bioproject">BioProject</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'BioSample') ? 'active' : '' }}" href="/biosample">BioSample</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === 'BioArchive') ? 'active' : '' }}" href="/bioarchive">BioArchive</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto ms-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>