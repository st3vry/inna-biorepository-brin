@extends('layouts.main')
@section('container')
<div class="container mt-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </div>
    <div class="table-responsive col-lg-12">
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
                    <td>{{ $biosample->organism->name }}</td>
                    <td>{{ $biosample->title }}</td>
                    <td>{{ $biosample->description }}</td>
                    <td>{{ $biosample->center->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection