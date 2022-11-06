@extends('dashboard.layouts.main')

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
<div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
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
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->lab->name }}</td>
                <td>{{ $user->lab->center->name }}</td>
                <td>{{ $user->role->name }}</td>
                <td>@if ($user->is_activated) Active @else Inactive @endif</td>
                <td>
                    <a href="/dashboard/users/{{$user->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/users/{{$user->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>

@endsection