@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Biotic Relationship</li>
    </ol>
</div>
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif
<a href="/dashboard/captures/create" class="btn btn-primary mb-3">Create Capture</a>
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $captures as $capture )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $capture->name }}</td>
                {{-- <td>{{ $bioticrel->description }}</td> --}}
                <td>
                    <a href="/dashboard/captures/{{$capture->id}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/captures/{{$capture->id}}" method="post" class="d-inline">
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