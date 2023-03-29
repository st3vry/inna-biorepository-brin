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
    <!-- <h1 class="h2"> Accession : {{$bioarchive->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioarchives">Bioarchives</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioarchive->accession}}</li>
    </ol>
</div>
<div class="row">
    <div class="table-responsive col-md-8">
        <table class="table table-sm">
            <tr>
                <td>Bioproject Accession </td>
                <td>:</td>
                <td class="col-sm-10"><strong>{{$bioarchive->bioproject->accession}}</strong></td>
            </tr>
            <tr>
                <td>Biosample Accession </td>
                <td>:</td>
                <td class="col-sm-10">
                    <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                        @foreach ($biosample_id as $item => $value)
                        <tr>
                            <td>
                                {{\App\Models\Biosample::select('accession')->where('id', $value)->pluck('accession')->first();}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
               </td>
            </tr>
            <tr>
                <td>Bioexperiment </td>
                <td>:</td>
                <td class="col-sm-10">
                    <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                        @foreach ($bioexperiment as $item => $value)
                        <tr>
                            <td><strong>Biosample</strong></td>
                            <td><strong>{{\App\Http\Controllers\DashboardBioarchiveController::biosampleName($value['biosample_id'])}}</strong></td>
                        </tr>
                        <tr>
                            <td>Alias</td>
                            <td>{{ $value['alias'] }}</td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $value['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Library Name</td>
                            <td>{{ $value['libname'] }}</td>
                        </tr>
                        <tr>
                            <td>Library Source</td>
                            <td>{{\App\Http\Controllers\DashboardBioarchiveController::getLibSourceName($value['libsource_id']);}}</td>
                        </tr>
                        <tr>
                            <td>Library Selection</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibSelectionName($value['libselection_id']);}} </td>
                        </tr>
                        <tr>
                            <td>Library Strategy</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibStrategyName($value['libstrategy_id']);}}</td>
                        </tr>
                        <tr>
                            <td>Library Con Protocol</td>
                            <td>{{ $value['libconsprot'] }}</td>
                        </tr>
                        <tr>
                            <td>Instrument</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getInstrumentName($value['instrument_id'])}}</td>
                        </tr>
                        <tr>
                            <td>Library layout</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibLayoutName($value['liblayout_id'])}}</td>
                        </tr>
                        <tr>
                            <td>Input Size</td>
                            <td>{{ $value['input_size'] }}</td>
                        </tr>
                        @if ($bioarchive->status == 4)

                        <tr>
                            <td>SFTP Link</td>
                            <td><a href="#">{{ $value['alias'] }}</a></td>
                        </tr>
                            
                        @endif
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <div class="card m-2">
            <div class="card-header">
                <h6>History</h6>
            </div>
            <div class="card-body">
                <section>
                    <ul class="timeline">

                        @if ($bioarchive->published_at !== null)
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">Published</strong>
                            <p class="fw-lighter mb-1">{{$bioarchive->published_at->format('j F Y H:i')}}</p>
                        </li>
                        @endif
                        @foreach ($histories as $history)
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">{{preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($history->action))}} by {{explode(' ', trim($history->creator->name))[0]}}</strong>
                            <p class="fw-lighter mb-1">{{$history->created_at->format('j F Y H:i')}}</p>
                            <p class="text-muted">
                                {{$history->desc}}
                            </p>
                        </li>
                        @endforeach
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">Bioarchive Created </strong>
                            <p class="fw-lighter mb-1">{{$bioarchive->created_at->format('j F Y H:i')}}</p>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection