@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Organism</li>
    </ol>
</div>
<a href="/dashboard/bioprojects/create" class="btn btn-primary mb-3">Create Organism</a>
<div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Taxon Id</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $organisms as $organism )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $organism->taxon_id }}</td>
                <td>{{ $organism->name }}</td>
                <td>
                    <a href="" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <a href="" class="badge bg-danger"><span data-feather="x-circle"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection