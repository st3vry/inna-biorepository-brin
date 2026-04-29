@extends('dashboard.layouts.main')
@section('title', 'Permission Request List')


@push('css')
<link href="/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush


@section('container')

@section('breadcrumb')
    <li class="breadcrumb-item" ><a href="/dahboard">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permission Request List</li>
@endsection

{{-- Flash Message Section --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- <a href="/dashboard/bioprojects/create" class="btn btn-primary mb-3">Create New Bioproject</a> --}}

<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
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
                                    <a href="/dashboard/dissem/permission-approval/{{ $permissionReq->bioarchive_accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('js')
    <script src="/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- dataTables.bootstrap5 -->
    <script src="/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- buttons.colVis -->
    <script src="/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <script src="/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

    <!-- dataTable.responsive -->
    <script src="/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- dataTables.select -->
    <script src="/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>
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
