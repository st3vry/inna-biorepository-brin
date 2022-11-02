@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2"> Accession : {{$bioproject->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioprojects">Bioproject</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
</div>
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <tr>
            <td class="col-sm-1">Title</td>
            <td class="col-sm-7">{{$bioproject->title}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Organism</td>
            <td class="col-sm-7">{{$bioproject->organism->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Description</td>
            <td class="col-sm-7">{{$bioproject->description}}</td>
        </tr>

    </table>
</div>
@endsection