@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2"> Accession : {{$bioarchive->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioarchives">Bioarchives</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioarchive->accession}}</li>
    </ol>
</div>
<div class="table-responsive col-lg-12">
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
                        <td><strong>{{\App\Models\Biosample::select('accession')->where('id', $value['biosample_id'] )->pluck('accession')->first(); }}</strong></td>
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
                        <td>{{\App\Models\LibrarySource::select('name')->where('id', $value['libsource_id'])->pluck('name')->first();  }}</td>
                    </tr>
                    <tr>
                        <td>Library Selection</td>
                        <td>{{\App\Models\LibrarySelection::select('name')->where('id',  $value['libselection_id'])->pluck('name')->first(); }}</td>
                    </tr>
                    <tr>
                        <td>Library Strategy</td>
                        <td>{{ \App\Models\LibraryStrategy::select('name')->where('id',  $value['libstrategy_id'])->pluck('name')->first(); }}</td>
                    </tr>
                    <tr>
                        <td>Library Con Protocol</td>
                        <td>{{ $value['libconsprot'] }}</td>
                    </tr>
                    <tr>
                        <td>Instrument</td>
                        <td>{{ \App\Models\Instrument::select('name')->where('id',  $value['instrument_id'])->pluck('name')->first(); }}</td>
                    </tr>
                    <tr>
                        <td>Library layout</td>
                        <td>{{ \App\Models\LibraryLayout::select('name')->where('id', $value['liblayout_id'])->pluck('name')->first(); }}</td>
                    </tr>
                    <tr>
                        <td>Input Size</td>
                        <td>{{ $value['input_size'] }}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>

    </table>
</div>
@endsection