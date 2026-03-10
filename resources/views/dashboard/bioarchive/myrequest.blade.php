@extends('dashboard.layouts.main')

@section('title', 'My Requests')

@push('css')
<link href="{{ asset('libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('container')

<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">My Requests</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
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
                        <td>
                            @if($request->is_declined)
                            <button type="button" class="btn btn-danger btn-sm" disabled>Rejected</button>
                            @elseif($request->is_approved)
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
    </div>
</div>

@endsection


@push('js')
    <script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
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
