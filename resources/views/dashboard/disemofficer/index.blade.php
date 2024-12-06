@extends('dashboard.layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Permission Request List</li>
    </ol>
</div>
{{-- <a href="/dashboard/bioprojects/create" class="btn btn-primary mb-3">Create New Bioproject</a> --}}
<div class="table-responsive col-md-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Accession</th>
                <th scope="col">Reason</th>
                <th scope="col">Research Area</th>
                <th scope="col">user_id</th>                
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $permissionReqs as $permissionReq )
            <tr>
                <td class="text-center"></td>
                <td>{{ $permissionReq->bioarchive_accession }}</td>
                <td>{{ $permissionReq->reason}}</td>
                <td>{{ $permissionReq->research_area}}</td>
                <td>{{ $permissionReq->user_id }}</td>

                
                <td class="text-center align-middle" style="white-space: nowrap">
                    <a href="/dashboard/bioprojects/{{ $permissionReq->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
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
