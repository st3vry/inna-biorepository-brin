@extends('dashboard.layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Bioarchives</li>
    </ol>
</div>
<a href="/dashboard/bioarchives/create" class="btn btn-primary mb-3">Create New Bioarchive</a>
<div class="table-responsive col-md-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Accession</th>
                <th scope="col">Submission ID</th>
                <th scope="col">Bioproject</th>
                <th scope="col">Biosample</th>
                <th scope="col">Status</th>
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
                <td class="text-center"></td>
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
                <td class="text-center align-middle">
                    @switch($bioarchive->status)
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
                            <span class="button badge bg-warning">Waiting for File upload</span>
                            @break
                        @case(5)
                            <span class="badge bg-success">Published</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Rejected</span>
                    @endswitch
                </td>
                <td class="text-center align-middle" style="white-space: nowrap">
                    @if (!$bioarchive->draft)
                        <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @else
                        @if ($bioarchive->status==4)
                            <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="upload"></span></a>
                        @else
                            <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                            {{-- <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a> --}}
                            <form action="/dashboard/bioarchives/{{$bioarchive->accession}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


@push('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            const dataTable = $('#dataTable').DataTable({
                    columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: 0,
                    },
                ],
                order: [[1, 'asc']],
            });
            dataTable.on('order.dt search.dt', function () {
                let i = 1;

                dataTable.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                    this.data(i++);
                });
            }).draw();
        });

    </script>

@endpush
