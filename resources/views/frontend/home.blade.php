@extends('layouts.main')
@section('container')
<!-- ======= Hero Section ======= -->
<section id="hero" class="masthead">
    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up" class="text-uppercase">Indonesian Nucleotide Archives</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">A life sciences, agriculture, and bioinformatics for biodiversity data repository platform</h2>
                <div data-aos="fade-right" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="#features" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>Get Started</span>
                        <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 hero-img align-items-center py-md-5" >
                <div class="d-flex align-items-center justify-content-md-end justify-content-around">
                    <img src="images/brin.png" alt="Logo Brin" class="img-fluid m-3" width="130px" data-aos="fade-left" data-aos-delay="200">
                    <img src="images/lpdp.png" alt="Logo LPDP" class="img-fluid m-3" width="130px" data-aos="fade-left" data-aos-delay="200">
                </div>
                <img src="images/inna-illustrator.svg" class="img-fluid" alt="Inna Lab" data-aos="zoom-out" data-aos-delay="200">
            </div>
        </div>
    </div>
</section>
<!-- End Hero -->


<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">
    <header class="section-header">
        {{-- <h2>Features</h2> --}}
        <p>About</p>
    </header>
    <div class="row gx-0">

        <div class="col-lg-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="images/programming.svg" class="img-fluid svg-bg" alt="">
        </div>
        <div class="col-lg-7 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
                <p class="text-end">
                Indonesian Nucleotide Archive (InNA) is a repository platform to store nucleotide (DNA/RNA) data to support life sciences, agriculture, and bioinformatics for biodiversity data disclosure, utilization of food genetic resources, precision medicine, etc. InNA can be accessed freely and publicly by researcher or scientists for research. If the data is restricted to be stored and used, please consult Principal Investigator project or your local institutional before uploading it to InNA. InNA is sdeveloped by Research Center for Computing, National Research and Innovation Agency. We are also developing analysis platform for advanced analysis of nucleotide (DNA/RNA) data called INNAlysis.
                </p>
            </div>
            </div>
        </div>
    </div>

</section>
<!-- End About Section -->

<!-- ======= Features Section ======= -->
<section id="features" class="features pt-0">
    <header class="section-header">
        {{-- <h2>Features</h2> --}}
        <p>Data Collection</p>
    </header>
    <div class="container" data-aos="fade-up">
        <div class="text-center mt-4">
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle" id="search" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">
                        <span data-feather="search"></span>
                    </button>
                </div>
                <ul class="dropdown-menu text-dark" id="searchResult" style="width:100%">
                    <li class="mx-3"><span>Search Bioproject, Biosample, Bioarchive</span></li>
                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3 mt-5 mt-lg-0 mb-5 d-flex">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="count-box" onclick="location.href='/bioprojects';">
                        <i class="bi bi-globe-asia-australia"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{$bioprojects_count}}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>BioProjects</p>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="count-box" onclick="location.href='/biosamples';">
                        <i class="bi bi-gender-ambiguous" style="color: #ee6c20;"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{$biosamples_count}}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>BioSamples </p>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="count-box"  onclick="location.href='/bioarchives';">
                            <i class="bi bi-box" style="color: #15be56;"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{$bioarchives_count}}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>BioArchives</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 feture-tabs aos-init aos-animate">
                <!-- Tabs -->
                <ul class="nav nav-pills mb-3">
                    <li>
                        <a class="nav-link active pt-0" data-bs-toggle="pill" href="#tab1">Latest Release</a>
                    </li>
                    <li>
                        <a class="nav-link pt-0" data-bs-toggle="pill" href="#tab2">Data in Concern</a>
                    </li>
                </ul><!-- End Tabs -->

                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1">
                        <div class="col-md-12" data-aos="fade-up">
                            <div>
                                <h4>BioProject</h4>
                                <div class="list-group list-group-flush pe-3">
                                    @if (count($bioprojects_latest)>0)
                                        @foreach ($bioprojects_latest as $item)
                                        <a href="bioprojects/{{ $item->accession }}" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold"> {{ $item->accession }}</p>
                                            <small>{{ $item->title }}</small>
                                        </a>
                                        @endforeach
                                    @else
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold">No Data</p>
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2" data-aos="fade-up">
                            <div>
                                <h4>BioSample</h4>
                                <div class="list-group list-group-flush pe-3">
                                        @if (count($biosamples_latest)>0)
                                        @foreach ($biosamples_latest as $item)
                                        <a href="biosamples/{{ $item->accession }}" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold"> {{ $item->accession }}</p>
                                            <small>{{ $item->title }}</small>
                                        </a>
                                        @endforeach
                                    @else
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold"> No Data</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt-2" data-aos="fade-up">
                            <div>
                                <h4>BioArchive</h4>
                                <div class="list-group list-group-flush pe-3">
                                        @if (count($bioarchives_latest)>0)
                                        @foreach ($bioarchives_latest as $item)
                                        <a href="bioarchives/{{ $item->accession }}" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold"> {{ $item->accession }}</p>
                                            <small>{{ $item->title }}</small>
                                        </a>
                                        @endforeach
                                    @else
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <p class="mb-1 fw-bold"> No Data</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- End Tab 1 Content -->

                    <div class="tab-pane fade show" id="tab2">
                        <div class="list-group list-group-flush pe-3">
                            @foreach ($data_in_concerns as $item)
                            <a href="biosamples/{{ $item->biosample->accession }}" class="list-group-item list-group-item-action">
                                <p class="mb-1 fw-bold">{{ $item->biosample->accession }}</p>
                                <small>{{ $item->biosample->title }}</small>
                            </a>
                            @endforeach
                        </div>
                    </div><!-- End Tab 2 Content -->
                </div>
            </div>

            <div class="col-lg-3 mt-5 mt-lg-0 d-flex">
                <div class="row align-self-start gy-4">

                    <div class="col-md-12" data-aos="zoom-out" data-aos-delay="200">
                        <div class="feature-box d-flex align-items-center"  onclick="location.href='/dashboard';">
                            <i class="bi bi-cloud-upload"></i>
                            <h3>Submit</h3>
                        </div>
                    </div>

                    {{-- <div class="col-md-12" data-aos="zoom-out" data-aos-delay="300">
                        <div class="feature-box d-flex align-items-center" >
                            <i class="bi bi-binoculars"></i>
                            <h3>Browse</h3>
                        </div>
                    </div> --}}

                    <div class="col-md-12" data-aos="zoom-out" data-aos-delay="400">
                        <div class="feature-box d-flex align-items-center" onclick="location.href='/bioarchives';">
                            <i class="bi bi-cloud-download"></i>
                            <h3>Download</h3>
                        </div>
                    </div>

                    <div class="col-md-12" data-aos="zoom-out" data-aos-delay="500">
                        <div class="feature-box d-flex align-items-center" onclick="location.href='/bioprojects';">
                            <i class="bi bi-file-earmark-medical"></i>
                            <h3>Research</h3>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- / row -->
    </div>
</section><!-- End Features Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">

    <div class="container" data-aos="fade-up">

    <header class="section-header">
        <p>Contact Us</p>
    </header>

    <div class="row gy-4">

        <div class="col-lg-12">

        <div class="row gy-4">
            <div class="col-md-6">
            <div class="info-box">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>Jl. Raya Jakarta-Bogor No.Km.46<br>Cibinong-Bogor, 16911</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="info-box">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p>+62 811 111 111 <br>+62 812 2222 2222 </p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="info-box">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>inna@brin.go.id <br>admin_inna@brin.go.id </p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="info-box">
                <i class="bi bi-clock"></i>
                <h3>Open Hours</h3>
                <p>Monday - Friday<br>08:00 - 17:00</p>
            </div>
            </div>
        </div>

        </div>

        {{-- <div class="col-lg-6">
        <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">

            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>

            <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
            </div>

            <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
            </div>

            <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
            </div>

            <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
            </div>

            </div>
        </form>

        </div> --}}

    </div>

    </div>

</section>
<!-- End Contact Section -->

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            async function search(searchVal) {
                const response = await fetch('/search', {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ "search": searchVal, "searchType": "all", '_token': '{{ csrf_token() }}'})
                })
                return await response.json();

            }
            const searchResult = document.getElementById('searchResult');
            const searchInput = document.getElementById('search');
            const boldSearchInput = (sentence, characters) => {
                const regEx = new RegExp(characters, 'gi');
                return sentence.replace(regEx, '<strong>$&</strong>')
            }

            function createSearchList(text, target=null) {
                const li = document.createElement('li')
                const a = document.createElement('a')
                a.classList.add('dropdown-item')
                if (target === null) {
                    a.innerHTML = text.bold()
                    a.href = 'javascript:void(0)'
                    li.appendChild(a)
                    searchResult.appendChild(li)
                } else {
                    a.innerHTML = boldSearchInput(text,searchInput.value)
                    a.href = target
                    li.appendChild(a)
                    li.classList.add('mx-2')
                    searchResult.appendChild(li)
                }
            }

            function appendSearchResult(results) {
                console.log(results)
                if (results.bioprojects.length > 0 ) {
                    createSearchList("Bioprojects")
                    results.bioprojects.forEach(bioproject  => {
                        createSearchList(bioproject.title, "/bioprojects/"+bioproject.accession)
                    });
                }
                if (results.biosamples.length > 0 ) {
                    const divider = document.createElement('li')
                    divider.innerHTML='<hr class="dropdown-divider">'
                    searchResult.appendChild(divider)
                    createSearchList("Biosamples")
                    results.biosamples.forEach(biosample => {
                        createSearchList(biosample.title, "/biosamples/"+biosample.accession)
                    });
                }

                if (results.bioarchives.length > 0 ) {
                    const divider = document.createElement('li')
                    divider.innerHTML='<hr class="dropdown-divider">'
                    searchResult.appendChild(divider)
                    createSearchList("Bioarchives")
                    results.bioarchives.forEach(bioarchive => {
                        createSearchList(bioarchive.accession, "/bioarchives/"+bioarchive.accession)
                    });
                }
                if (results.bioprojects.length ===0 && results.biosamples.length ===0 && results.bioarchives.length ===0 ) {
                    searchResult.innerHTML = '<li class="mx-3">No result found for <strong>'+searchInput.value+'</strong></li>'
                }
            }

            searchInput.addEventListener('keyup', function(e){
                searchResult.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-danger" role="status"></div></div>'
                if (this.value.length >= 1 ) {
                    search(this.value).then(results => {
                        searchResult.innerHTML = ''
                        appendSearchResult(results)
                    })
                } else {
                    searchResult.innerHTML = '<li class="mx-3"><span>Search Bioproject, Biosample, Bioarchive</span></li>'
                }
            })
        });



    </script>

@endpush
