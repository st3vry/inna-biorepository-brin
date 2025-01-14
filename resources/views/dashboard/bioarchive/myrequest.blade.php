@extends('dashboard.layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Request</li>
    </ol>
</div>
{{-- <a href="/dashboard/bioarchives/create" class="btn btn-primary mb-3">Create New Bioarchive</a> --}}
<div class="table-responsive col-md-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Accession</th>
                <th scope="col">Research Area</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $requests as $request )
            <tr>
                <td class="text-center"></td>
                <td>{{ $request->bioarchive_accession }}</td>
                <td>{{ $request->research_area }}</td>
                {{-- {{ dd($request->is_approved) }} --}}
                <td>
                    @if($request->is_declined)
                    <!-- Entry exists but is_agreed/is_approve is false -->
                    <button type="button" class="btn btn-danger btn-sm" disabled>Rejected</button>
                    @elseif($request->is_approved)
                    {{-- <a href="{{ route('download', ['id' => $permission_info->id]) }}" class="btn btn-success btn-sm">Download</a> --}}
                    <a href="{{ route('folder.index', ['relativePath' => $request->path]) }}" class="btn btn-success btn-sm">Download</a>
                    @elseif(!$request->is_declined && !$request->is_approved)
                    <button type="button" class="btn btn-warning btn-sm" disabled>Waiting for Approval</button>
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
