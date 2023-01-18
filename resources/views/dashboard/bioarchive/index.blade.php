@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Bioarchives</li>
    </ol>
</div>
<a href="/dashboard/bioarchives/create" class="btn btn-primary mb-3">Create New Bioarchive</a>
<div class="table-responsive col-md-11">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Accession</th>
                <th scope="col">Organism</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Center</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>

@endsection