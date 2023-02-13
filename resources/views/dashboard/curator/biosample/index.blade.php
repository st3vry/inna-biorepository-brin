@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Curator Biosamples</li>
    </ol>
</div>
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
                <td>{{ $biosample->organism->name }}</td>
                <td>{{ $biosample->title }}</td>
                <td>{{ $biosample->description }}</td>
                <td>{{ $biosample->center->name }}</td>
                <td>
                    @if(isset($biosample->published_at))
                        <span class="badge bg-success">Published</span>
                    @else
                        @if($biosample->draft)
                            @if (isset($biosample->curator_id))
                                <span class="badge bg-warning">Returned to submitter</span>
                            @else   
                                <span class="badge bg-warning">Draft</span>                 
                            @endif
                        @else
                            @if (isset($biosample->curator_id))
                                <span class="badge bg-info">On review</span>
                            @else   
                                <span class="badge bg-danger">Unassigned</span>          
                            @endif
                        @endif
                    @endif
                </td>
                <td>
                    @if (!$biosample->draft)
                    <a href="/dashboard/curator/biosamples/{{ $biosample->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @else
                    <a href="/dashboard/curator/biosamples/{{ $biosample->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/curator/biosamples/{{ $biosample->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/curator/biosamples/{{$biosample->accession}}" method="post" class="d-inline">
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