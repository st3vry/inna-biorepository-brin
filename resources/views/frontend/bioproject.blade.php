@extends('layouts.main')
@section('container')
<div class="container  mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-4">
            <strong>Organism</strong>
            <ul class="ps-2" type="none">
                @if (count($organisms)>0)
                    @foreach ($organisms as $organism)
                        <li><a href="/bioprojects?organism={{Crypt::encrypt($organism->id)}}" class="text-sidebar">{{$organism->name}} ({{$organism->count}})</a></li>
                    @endforeach
                @else
                    <li class="disabled">No Data</li>
                @endif
            </ul>
            {{-- <strong>Centers</strong>
            <ul class="ps-2" type="none">
                @if (count($centers) > 0)
                    @foreach ($centers as $center)
                        <li><a href="/bioprojects?center={{Crypt::encrypt($center->id)}}" class="text-sidebar">{{$center->name}} ({{$center->count}})</a></li>
                    @endforeach
                @else
                    <li class="disabled">No Data</li>
                @endif
            </ul> --}}
            <strong>Scope</strong>
            <ul class="ps-2" type="none">
                @if (count($scopes)>0)
                    @foreach ($scopes as $scope)
                        <li><a href="/bioprojects?scope={{Crypt::encrypt($scope->id)}}" class="text-sidebar">{{$scope->name}} ({{$scope->count}})</a></li>
                    @endforeach
                @else
                    <li class="disabled">No Data</li>
                @endif
            </ul>
        </div>
        <div class="col-lg-10 col-md-8">
            <div class="input-group  mb-3">
                <input type="text" class="form-control dropdown-toggle" id="search" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">
                        <span data-feather="search"></span>
                    </button>
                </div>
                <ul class="dropdown-menu text-dark" id="searchResult" style="width:100%">
                    <li class="mx-3"><span>Search Bioproject</span></li>
                </ul>
            </div>
            @foreach ( $bioprojects as $bioproject )
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="width: auto"><h6>{{ ($bioprojects->currentPage() - 1) * $bioprojects->perPage() + $loop->iteration }}</h6></div>
                        <div class="col-11">
                            <a href="bioprojects/{{ $bioproject->accession }}" class="text-dark"><h6 class="card-title fw-bold">{{ $bioproject->title }}</h6></a>
                            <p class="mb-1">{{ Str::words($bioproject->description,20, ' ')}} <a href="javascript:void(0)" class="text-brin-no-decor" onclick="readMore(this)"> Read more...</a></p>
                            <p class="mb-1 d-none">{{ $bioproject->description}} <a href="javascript:void(0)" class="text-brin-no-decor" onclick="readLess(this)"> Read less.</a></p>
                            <p class="fw-light mb-0">Organism: {{ $bioproject->organism->name }}</p>
                            <p class="fw-light mb-0">Scope: {{ $bioproject->samplescope->name }}</p>
+                            @php
+                                $userData = json_decode($bioproject->user->user_data);
+                                $centerName = $userData->pegawaiData->administrative_name ?? 'N/A';    
+                            @endphp
+                            <p class="fw-light mb-0">Organization: {{ $bioproject->center->name ??  $centerName }}</p>
                            <p class="fw-lighter mb-0">Accession: {{ $bioproject->accession }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{$bioprojects->links()}}
        </div>
    </div>

    {{-- <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Accession</th>
                    <th scope="col">Organism</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Center</th>

                </tr>
            </thead>
            <tbody>
                @foreach ( $bioprojects as $bioproject )
                <tr>
                    <td>{{ ($bioprojects->currentPage() - 1) * $bioprojects->perPage() + $loop->iteration }}</td>
                    <td><a href="bioprojects/{{ $bioproject->accession }}">{{ $bioproject->accession }}</a></td>
                    <td>{{ $bioproject->organism->name }}</td>
                    <td>{{ $bioproject->title }}</td>
                    <td>{{ $bioproject->description }}</td>
                    <td>{{ $bioproject->center->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$bioprojects->links()}} --}}
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
                    body: JSON.stringify({ "search": searchVal, "searchType": "bioproject", '_token': '{{ csrf_token() }}'})
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
