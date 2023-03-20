@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Biosamples</li>
    </ol>
</div>
<a href="/dashboard/biosamples/create" class="btn btn-primary mb-3">Create New Biosample</a>
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
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $biosamples as $biosample )
            <tr>

                <td>{{ ($biosamples->currentPage() - 1) * $biosamples->perPage() + $loop->iteration }}</td>
                <td>{{ $biosample->accession }}</td>
                <td>{{ $biosample->organism_name }}</td>
                <td>{{ $biosample->title }}</td>
                <td>{{ $biosample->description }}</td>
                <td>{{ $biosample->center->name }}</td>
                <td>
                    @switch($biosample->status)
                        @case(1)
                            <span class="badge bg-danger">Unassigned</span>  
                            @break
                        @case(2)
                            <span class="badge bg-info">On review</span>
                            @break
                        @case(3)
                            <span class="badge bg-warning">Returned to submitter</span>
                            @break
                        @case(4)
                            <span class="badge bg-warning">Waiting for File upload</span>
                            @break
                        @case(5)
                            <span class="badge bg-success">Published</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Rejected</span>
                    @endswitch
                </td><td>
                    @if (!$biosample->draft)
                    <a href="/dashboard/biosamples/{{ $biosample->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @else
                    <a href="/dashboard/biosamples/{{ $biosample->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/biosamples/{{ $biosample->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/biosamples/{{$biosample->accession}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$biosamples->links();}}
</div>

@endsection