@extends('layouts.main')
@section('container')
<div class="container mt-3">
    <div class="container">
        <div class="text-center mt-3">
            <div class="input-group">

                <input type="text" class="form-control" placeholder="Search Bioproject, Biosample, Bioarchive">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">
                        <span data-feather="search"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-9 mb-2">
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Bio Archive</h5>
                        </div>
                        <div class="card-body">
                            <p align="justify">Indonesia Nucleotide Archive (InNA) is a repository platform to store nucleotide (DNA/RNA) data to support life sciences, agriculture, and bioinformatics for biodiversity data disclosure, utilization of food genetic resources, precision medicine, etc. InNA can be accessed freely and publicly by researcher or scientists for research. If the data is restricted to be stored and used, please consult Principal Investigator project or your local institutional before uploading it to InNA.
                                InNA is sdeveloped by Research Center for Computing, National Research and Innovation Agency. We are also developing analysis platform for advanced analysis of nucleotide (DNA/RNA) data called INNAlysis.</p>
                            <section class="text-center">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
                                        <a href="/dashboard" class="nav-link text-muted">
                                            <h6 class="fw-normal mb-2">Submit</h6>
                                            <span data-feather="upload-cloud"></span>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
                                        <a href="/browse" class="nav-link text-muted">
                                            <h6 class="fw-normal mb-2">Browse</h6>
                                            <span data-feather="globe"></span>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5 mb-md-0 position-relative">
                                        <a href="/download" class="nav-link text-muted">
                                            <h6 class="fw-normal mb-2">Download</h6>
                                            <span data-feather="download"></span>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5 mb-md-0 position-relative">
                                        <a href="/document" class="nav-link text-muted">
                                            <h6 class="fw-normal mb-2">Document</h6>
                                            <span data-feather="file-text"></span>
                                        </a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Collection</h5>
                        </div>
                        <div class="card-body">
                            <section class="text-center">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
                                        <a href="/bioprojects" class="nav-link text-muted">
                                            <span data-feather="list"></span>
                                            <h5 class="text-danger fw-bold mb-2"></h5>
                                            <h6 class="fw-normal mb-0">BioProject</h6>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-5 mb-md-5 mb-lg-0 position-relative">
                                        <a href="/biosamples" class="nav-link text-muted">
                                            <span data-feather="layers"></span>
                                            <h5 class="text-danger fw-bold mb-2"></h5>
                                            <h6 class="fw-normal mb-0">BioSample</h6>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-5 mb-md-0 position-relative">
                                        <a href="/bioarchives" class="nav-link text-muted">
                                            <span data-feather="hard-drive"></span>
                                            <h5 class="text-danger fw-bold mb-2"></h5>
                                            <h6 class="fw-normal mb-0">BioArchive</h6>
                                            <div class="vr vr-blurry position-absolute my-0 h-100 d-none d-md-block top-0 end-0"></div>
                                        </a>
                                    </div>


                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Statistics</h5>
                        </div>
                        <div class="card-body text-center">
                            <center>
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data in Concern</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Data1</li>
                                <li>Data2</li>
                                <li>Data3</li>
                                <li>Data4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Help & Support</h5>
                        </div>
                        <div class="card-body">

                            <p class="card-text">If you have any question or would like to give us any suggestion/comment or report a bug, please feel free to contact us.<br>
                                <strong>Email : admin_inna@brin.go.id</strong><br>
                                <strong>Contact : 081222222</strong><br>
                                We highly appreciate your comments and suggestions for further improvements.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-deck mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest Released Data</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Data1</li>
                                <li>Data2</li>
                                <li>Data3</li>
                                <li>Data4</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection