@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2"> Accession : {{$bioproject->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioprojects">Bioproject</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioproject->accession}}</li>
    </ol>
</div>
<div class="table-responsive col-lg-8">
    <table class="table table-striped table-sm">
        <tr>
            <td class="col-sm-1">Title</td>
            <td class="col-sm-7">{{$bioproject->title}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Umbrella Projects</td>
            @isset($umbrella)
            <td class="col-sm-7"><a href="{{ $umbrella->accession }}">{{ $umbrella->accession }}</a> &mdash; {{$umbrella->title}}</td>
            @endisset
            <td class="col-sm-7">Not Assigned</td>
        </tr>
        <tr>
            <td class="col-sm-1">Consortium</td>
            @isset($umbrella)
            <td class="col-sm-7">{{$bioproject->consortium->name}} &mdash; <a href="https://www.{{ $umbrella->consortium->url }}">{{ $umbrella->consortium->url }}</a></td>
            @endisset
            <td class="col-sm-7">Not Assigned</td>
        </tr>
        <tr>
            <td class="col-sm-1">Organism</td>
            <td class="col-sm-7">{{$bioproject->organism->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Description</td>
            <td class="col-sm-7">{{$bioproject->description}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Relevance</td>
            <td class="col-sm-7">{{$relevance->relevance->name}}
                @if ($relevance->relevance->id == 7)
                &mdash; {{$relevance->description}}
                @endif </td>
        </tr>
        <tr>
            <td class="col-sm-1">Material</td>
            <td class="col-sm-7">{{$material->material->name}}
                @if ($material->material->id == 7)
                &mdash; {{$material->description}}
                @endif </td>
        </tr>
        <tr>
            <td class="col-sm-1">Capture</td>
            <td class="col-sm-7">{{$capture->capture->name}}
                @if ($capture->capture->id == 6)
                &mdash; {{$capture->description}}
                @endif </td>
        </tr>
        <tr>
            <td class="col-sm-1">Methodology</td>
            <td class="col-sm-7">{{$methodology->methodology->name}}
                @if ($methodology->methodology->id == 4)
                &mdash; {{$methodology->description}}
                @endif </td>
        </tr>

        <tr>
            <td class="col-sm-1">Publication</td>
            <td class="col-sm-7">
                <div class="card shadow-sm mb-2">
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            @forelse ( $pubs as $pub )
                            <tr>
                                <td class="col-sm-3">{{$pub->article_title}}</td>
                                <td class="col-sm-3">{{$pub->doi}}</td>
                            </tr>
                            @empty
                            None
                            @endforelse
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-sm-1">Grant</td>
            <td class="col-sm-7">
                <div class="card shadow-sm mb-2">
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            @forelse ( $grants as $grant )
                            <tr>
                                <td class="col-sm-3">{{$grant->grant_title}}</td>
                                <td class="col-sm-3">{{$grant->grant_program}}</td>
                                <td class="col-sm-3">{{$grant->fundagency->name}}</td>
                            </tr>
                            @empty
                            None
                            @endforelse
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-sm-1">Sample Scope</td>
            <td class="col-sm-7">{{$bioproject->samplescope->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Data Type</td>
            <td class="col-sm-7">
                <ul>
                    @foreach ( $data_types as $key => $value )
                    <li>{{$value}}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td class="col-sm-1">Center</td>
            <td class="col-sm-1">{{$bioproject->center->name}}
            </td>
        </tr>
        <tr>
            <td class="col-sm-1">Lab</td>
            <td class="col-sm-7">{{$bioproject->user->lab->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Submitter</td>
            <td class="col-sm-7">{{$bioproject->user->name}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Submitted at</td>
            <td class="col-sm-7">{{$bioproject->created_at->format('d-m-Y')}}</td>
        </tr>
        <tr>
            <td class="col-sm-1">Published at</td>
            <td class="col-sm-7">{{$bioproject->published_at === null ? 'None' : $bioproject->published_at->format('d-m-Y')}}</td>
        </tr>

    </table>
</div>
@endsection