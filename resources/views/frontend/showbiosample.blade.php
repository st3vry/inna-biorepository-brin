@extends('layouts.main')

@section('container')
<div class="container mt-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/biosamples">Biosample</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$biosample->accession}}</li>
        </ol>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
            <tr>
                <td class="col-sm-1">Title</td>
                <td class="col-sm-7">{{$biosample->title}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Organism</td>
                <td class="col-sm-7">{{$biosample->organism->name}}</td>
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
</div>
@endsection