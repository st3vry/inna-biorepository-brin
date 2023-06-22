@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Workflows</li>
    </ol>
</div>
<div class="col-lg-12" id="app">
{{-- {{ dd($workflows) }} --}}
{{-- <workflows-grid></workflows-grid> --}}
{{-- test --}}
    @if(Session::has('statusJob'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('statusJob') }}
        </div>
    @endif

</div>
<a href="/dashboard/innalysis_galaxy/create" class="btn btn-primary mb-3">Submit New Job</a>
<div class="table-responsive col-md-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Workflow</th>
                <th scope="col">Input 1</th>
                <th scope="col">Input 2</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($workflows as $item)
                <tr>
                    <td class="text-center"></td>
                    <td>{{ $item->wf_id }}</td>
                    <td>{{ $item->wf_id }}</td>
                    <td>{{ $item->wf_id }}</td>
                    <td>{{ $item->status }}</td>
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