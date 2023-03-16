@extends('dashboard.layouts.main')

@push('css')
<style>
    .timeline {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline .timeline-item {
        position: relative;
    }

    .timeline .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .timeline-item:after {
        background-color: hsl(0, 0%, 90%);
        left: -38px;
        border-radius: 50%;
        height: 11px;
        width: 11px;
        content: "";
    }
</style>
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/biosamples">Biosample</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$biosample->accession}}</li>
    </ol>
</div>
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <tr>
            <td class="col-sm-1">Title</td>
            <td class="col-sm-7">{{$biosample->title}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Organism</td>
            <td class="col-sm-7">{{$biosample->organism_name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Sample Type</td>
            <td class="col-sm-7">{{$biosample->sampletype->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Description</td>
            <td class="col-sm-7">{{$biosample->description}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Center</td>
            <td class="col-sm-1">{{$biosample->center->name}}
            </td>
        </tr>
        <tr>
            <td class="col-sm-1">Lab</td>
            <td class="col-sm-7">{{$biosample->user->lab->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Submitter</td>
            <td class="col-sm-7">{{$biosample->user->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Submitted at</td>
            <td class="col-sm-7">{{$biosample->created_at->format('d-m-Y')}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Published at</td>
            <td class="col-sm-7">{{$biosample->published_at === null ? 'None' : $biosample->published_at->format('d-m-Y')}}</td>
        </tr>

    </table>
</div>
@endsection