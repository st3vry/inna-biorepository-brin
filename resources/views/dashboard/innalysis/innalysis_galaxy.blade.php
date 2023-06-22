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
           
        </tbody>
    </table>
</div>

@endsection