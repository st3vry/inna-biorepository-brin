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
            <strong>Organism</strong>
            <ul class="ps-2" type="none">
                {{-- @foreach ($organisms as $organism)
                    <li><a href="#" class="text-sidebar">{{$organism->name}} ({{$organism->count}})</a></li>
                @endforeach --}}
            </ul>

            <strong>Center</strong>
            <ul class="ps-2" type="none">
                @foreach ($centers as $center)
                    <li><a href="#" class="text-sidebar">{{$center->name}} ({{$center->count}})</a></li>
                @endforeach
            </ul>

        </div>
        <div class="col-lg-10 col-md-8">
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
                            <p class="fw-lighter mb-0">Organization: {{ $bioarchive->bioproject->center_id }}</p>
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
