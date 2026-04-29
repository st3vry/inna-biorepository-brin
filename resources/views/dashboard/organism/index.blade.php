@extends('dashboard.layouts.main')
@section('title', 'Organism')

@push('css')
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
                <a href="/dashboard/organisms/create" class="btn btn-primary">Create Organism</a>
            </div>

            <div class="card-body">
                <div class="table-responsive col-lg-12">
                    <table class="table table-striped table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No.</th>
                                <th class="text-center" scope="col">Taxon Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $organisms as $organism )
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center">{{ $organism->taxon_id }}</td>
                                <td>{{ $organism->name }}</td>
                                <td>
                                    <a href="/dashboard/organisms/{{$organism->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                                    <form action="/dashboard/organisms/{{$organism->id}}" method="post" class="d-inline">
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