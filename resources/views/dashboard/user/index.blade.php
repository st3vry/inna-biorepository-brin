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
<!-- <a href="/dashboard/users/create" class="btn btn-primary mb-3">Create User</a> -->
<div class="row">
    <div class="d-flex justify-content-between bd-highlight mb-3">
        <div class="row col-md-4 col-sm-12">
            <div class="col-sm-6">
                <select class="form-select" name="entries" id="entries" onchange="filter()">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    {{-- <option value="0">All</option> --}}
                </select>
            </div>
            <label for="entries" class="col-sm-6 col-form-label">rows per page</label>
        </div>
        <div class="row col-md-4 col-sm-12">
            <input class="form-control" type="search" name="search" placeholder="Search" id="search" onkeyup="filter()">
        </div>
    </div>
</div>
<div id="user-table" class="table-responsive col-lg-12">
    @include('dashboard.user.table')
</div>

@endsection
@push('js')

    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const entries = document.getElementById('entries')
        const search = document.getElementById('search')
        const csrf = document.querySelector('meta[name="csrf-token"]').content
        const userTable =  document.getElementById('user-table')
        function filter() {
            fetch('{{route('users.filter')}}', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ "entries": entries.value, '_token': csrf, 'search': search.value })
            })
            .then(response => response.text())
            .then(response => userTable.innerHTML = response)
            // .then(feather.replace())
        }
        search.oninput = function () {
            if (this.value.length !== 1) {
                filter()
            }
        }
        
    </script>
@endpush