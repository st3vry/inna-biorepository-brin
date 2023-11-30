@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Workflows</li>
    </ol>
</div>

<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-sm">
            <tr>
                <td class="col-sm-1">Title</td>
                <td class="col-sm-7">{{$detail_wf->workflow_id}}</td>
            </tr>

        </table>
    </div>
</div>
@endsection