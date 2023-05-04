@extends('layouts.main')
@section('container')
<div class="container mt-3">
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
                @foreach ($organisms as $organism)
                    <li><a href="#" class="text-sidebar">{{$organism->name}} ({{$organism->count}})</a></li>
                @endforeach
            </ul>

            <strong>Center</strong>
            <ul class="ps-2" type="none">
                @foreach ($centers as $center)
                    <li><a href="#" class="text-sidebar">{{$center->name}} ({{$center->count}})</a></li>
                @endforeach
            </ul>

        </div>
        <div class="col-lg-10 col-md-8">
        @foreach ( $biosamples as $biosample )
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1" style="width: auto"><h6>{{ ($biosamples->currentPage() - 1) * $biosamples->perPage() + $loop->iteration }}</h6></div>
                        <div class="col-11">
                            <a href="biosamples/{{ $biosample->accession }}" class="text-dark"><h6 class="card-title fw-bold">{{ $biosample->title }}</h6></a>
                            <p class="mb-1">{{ Str::words($biosample->description,20, ' ')}} <a href="javascript:void(0)" class="text-brin-no-decor" onclick="readMore(this)"> Read more...</a></p>
                            <p class="mb-1 d-none">{{ $biosample->description}} <a href="javascript:void(0)" class="text-brin-no-decor" onclick="readLess(this)"> Read less.</a></p>
                            <p class="fw-light mb-0">Organism: {{ $biosample->organism->name }}</p>
                            {{-- <p class="fw-light mb-0">Scope: {{ $biosample->samplescope->name }}</p> --}}
                            <p class="fw-light mb-0">{{ $biosample->center->name }}</p>
                            <p class="fw-lighter mb-0">Accession: {{ $biosample->accession }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$biosamples->links()}}
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
                @foreach ( $biosamples as $biosample )
                <tr>
                    <td>{{ ($biosamples->currentPage() - 1) * $biosamples->perPage() + $loop->iteration }}</td>
                    <td><a href="biosamples/{{ $biosample->accession }}">{{ $biosample->accession }}</a></td>
                    <td>{{ $biosample->organism_name }}</td>
                    <td>{{ $biosample->title }}</td>
                    <td>{{ $biosample->description }}</td>
                    <td>{{ $biosample->center->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    
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