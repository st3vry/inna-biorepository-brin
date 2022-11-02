@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Bioproject</h1>
</div>
<div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Alias</th>
                <th scope="col">Organism</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $bioprojects as $bioproject )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $bioproject->alias }}</td>
                <td>{{ $bioproject->organism->name }}</td>
                <td>{{ $bioproject->title }}</td>
                <td>{{ $bioproject->description }}</td>
                <td>
                    <a href="/dashboard/bioprojects/{{ $bioproject->alias }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <a href="" class="badge bg-danger"><span data-feather="x-circle"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection