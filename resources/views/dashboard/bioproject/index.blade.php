@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Bioproject</li>
    </ol>
</div>
<a href="/dashboard/bioprojects/create" class="btn btn-primary mb-3">Create New Bioproject</a>
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
            @foreach ( $bioprojects as $bioproject )
            <tr>
                <td>{{ ($bioprojects->currentPage() - 1) * $bioprojects->perPage() + $loop->iteration }}</td>
                <td>{{ $bioproject->accession }}</td>
                <td>{{ $bioproject->organism->name }}</td>
                <td>{{ $bioproject->title }}</td>
                <td>{{ $bioproject->description }}</td>
                <td>{{ $bioproject->center->name }}</td>
                <td>
                    @if(isset($bioproject->published_at))
                        <span class="badge bg-success">Published</span>
                    @else
                        @if($bioproject->draft)
                            @if (isset($bioproject->curator_id))
                                <span class="badge bg-warning">Returned to submitter</span>
                            @else   
                                <span class="badge bg-warning">Draft</span>                 
                            @endif
                        @else
                            @if (isset($bioproject->curator_id))
                                <span class="badge bg-info">On review</span>
                            @else   
                                <span class="badge bg-danger">Unassigned</span>          
                            @endif
                        @endif
                    @endif
                </td>
                <td>
                    @if (!$bioproject->draft)
                    <a href="/dashboard/bioprojects/{{ $bioproject->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @else
                    <a href="/dashboard/bioprojects/{{ $bioproject->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/bioprojects/{{ $bioproject->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/bioprojects/{{$bioproject->accession}}" method="post" class="d-inline">
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
    {{$bioprojects->links();}}
</div>

@endsection