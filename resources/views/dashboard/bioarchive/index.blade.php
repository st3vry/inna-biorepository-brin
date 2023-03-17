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
                <th scope="col">Submission ID</th>
                <th scope="col">Bioproject</th>
                <th scope="col">Biosample</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $bioarchives as $bioarchive )
            <tr>
                <td>{{ ($bioarchives->currentPage() - 1) * $bioarchives->perPage() + $loop->iteration }}</td>
                <td>{{ $bioarchive->accession }}</td>
                <td>{{ $bioarchive->submission_id }}</td>
                <td>{{ $bioarchive->bioproject->accession }}</td>
                <td>
                    @foreach (explode(',', $bioarchive->biosample_id) as $biosample )
                        <table>
                            @php
                                $samples = DB::table('biosamples')->where('id', $biosample)->get();
                            @endphp
                            <tr>
                                @foreach ($samples as $smp)
                                <td>{{ $smp->accession }}</td>
                                @endforeach
                            </tr>
                        </table>
                    @endforeach
                </td>
                <td>
                    @if(isset($bioarchive->published_at))
                        <span class="badge bg-success">Published</span>
                    @else
                        @if($bioarchive->draft)
                            @if (isset($bioarchive->curator_id))
                                <span class="badge bg-warning">Returned to submitter</span>
                            @else   
                                <span class="badge bg-warning">Draft</span>                 
                            @endif
                        @else
                            @if (isset($bioarchive->curator_id))
                                <span class="badge bg-info">On review</span>
                            @else   
                                <span class="badge bg-danger">Unassigned</span>          
                            @endif
                        @endif
                    @endif
                </td>
                <td>
                    @if (!$bioarchive->draft)
                    <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @else
                    <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/bioarchives/{{$bioarchive->accession}}" method="post" class="d-inline">
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

</div>

@endsection