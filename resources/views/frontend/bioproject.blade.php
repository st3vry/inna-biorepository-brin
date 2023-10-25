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

            <strong>Scope</strong>
            <ul class="ps-2" type="none">
                @foreach ($scopes as $scope)
                    <li><a href="#" class="text-sidebar">{{$scope->name}} ({{$scope->count}})</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-10 col-md-8">
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
                            <p class="fw-light mb-0">{{ $bioproject->center_id }}</p>
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
