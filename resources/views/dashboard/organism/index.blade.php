@extends('dashboard.layouts.main')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Organism</li>
    </ol>
</div>
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif
<a href="/dashboard/organisms/create" class="btn btn-primary mb-3">Create Organism</a>
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