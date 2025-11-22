@extends('layouts.main')
@section('container')
<div class="container mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-4">
            {{-- <strong>Organism</strong>
            <ul class="ps-2" type="none">
                @foreach ($organisms as $organism)
                    <li><a href="#" class="text-sidebar">{{$organism->name}} ({{$organism->count}})</a></li>
                @endforeach
            </ul> --}}

            {{-- <strong>Center</strong>
            <ul class="ps-2" type="none">

                <li class="disabled">No Data</li>
                @if (count($centers) > 0)
                    @foreach ($centers as $center)
                        <li><a href="#" class="text-sidebar">{{$center->name}} ({{$center->count}})</a></li>
                    @endforeach
                @else
                    <li class="disabled">No Data</li>
                @endif
            </ul> --}}
        </div>
        <div class="col-lg-10 col-md-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control dropdown-toggle" id="search" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">
                        <span data-feather="search"></span>
                    </button>
                </div>
                <ul class="dropdown-menu text-dark" id="searchResult" style="width:100%">
                    <li class="mx-3"><span>Search Bioarchive</span></li>
                </ul>
            </div>
        @foreach ( $bioarchives as $bioarchive )
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="width: auto"><h6>{{ ($bioarchives->currentPage() - 1) * $bioarchives->perPage() + $loop->iteration }}</h6></div>
                        <div class="col-11">
                            <a href="bioarchives/{{ $bioarchive->accession }}" class="text-dark"><h6 class="card-title fw-bold">{{ $bioarchive->accession }}</h6></a>
                            <p class="fw-lighter mb-0">Accession: {{ $bioarchive->accession }}</p>
                            <p class="fw-lighter mb-0">Bioproject: {{ $bioarchive->bioproject->accession }}</p>
                            <p class="fw-lighter mb-0">Project Title: {{ $bioarchive->bioproject->title }}</p>
                            <p class="fw-lighter mb-0">Organization: {{ $bioarchive->bioproject->center->name ??  'N/A' }}</p>
                            {{-- <p class="fw-lighter mb-0">Biosample: {{ $bioarchive->biosample->accession }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$bioarchives->links()}}
        </div>
    </div>


</div>
@endsection
@push('js')
    <script>
        function readMore(el) {
            const parent = el.parentElement
            const next = parent.nextElementSibling
            parent.classList.add('d-none')
            next.classList.remove('d-none')
        }

        function readLess(el) {
            const parent = el.parentElement
            const prev = parent.previousElementSibling
            parent.classList.add('d-none')
            prev.classList.remove('d-none')
        }
    </script>
@endpush


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
                    body: JSON.stringify({ "search": searchVal, "searchType": "bioarchive", '_token': '{{ csrf_token() }}'})
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
