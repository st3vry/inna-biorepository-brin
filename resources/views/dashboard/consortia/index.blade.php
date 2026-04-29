@extends('dashboard.layouts.main')
@section('title', 'Consortium')

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('container')
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <a href="/dashboard/consortium/create" class="btn btn-primary">Create Consortium</a>
            </div>

            <div class="card-body">
                <div class="table-responsive col-lg-12">
                    <table class="table table-striped table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Url</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $consortium as $consortia )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $consortia->name }}</td>
                                <td>{{ $consortia->url }}</td>
                                
                                {{-- <td>{{ $bioticrel->description }}</td> --}}
                                <td>
                                    <a href="/dashboard/consortium/{{$consortia->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                                    <form action="/dashboard/consortium/{{$consortia->id}}" method="post" class="d-inline">
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