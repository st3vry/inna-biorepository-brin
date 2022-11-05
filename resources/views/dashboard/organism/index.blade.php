@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Organism</li>
    </ol>
</div>
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif
<a href="/dashboard/organisms/create" class="btn btn-primary mb-3">Create Organism</a>
<div class="table-responsive col-lg-8">
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
                    <a href="/dashboard/organisms/{{$organism->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/organisms/{{$organism->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection