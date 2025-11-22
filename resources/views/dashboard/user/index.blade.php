@extends('dashboard.layouts.main')

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User</li>
    </ol>
</div>
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif
<div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">UserName</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Lab</th>
                <th scope="col">Center</th>
                <th scope="col">Role</th>
                <th scope="col">IsActivated</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
            <tr>
                <td></td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @php
                    $userData = json_decode($user->user_data);
                    $centerName = $userData->pegawaiData->administrative_name ?? 'N/A';
                    $labName = $userData->pegawaiData->affiliate_name ?? 'N/A';
                @endphp
                <td>{{ $user->lab->name ?? $labName }}</td>
                <td>{{ $user->center->name ?? $centerName }}</td>
                <td>{{ $user->affiliate }}</td>
                <td>{{ $user->role->name }}</td>
                <td>@if ($user->is_activated) Active @else Inactive @endif</td>
                <td>
                    <a href="/dashboard/users/{{$user->id}}/edit" class="badge bg-warning"><i class="bi bi-pencil-square"></i></span></a>
                    <form action="/dashboard/users/{{$user->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><i class="bi bi-x-circle"></i></span></button>
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
