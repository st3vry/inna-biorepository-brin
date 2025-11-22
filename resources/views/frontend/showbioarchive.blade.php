@extends('layouts.main')

@section('container')
<div class="container  mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item"><a class="text-brin" href="/bioarchives">Bioarchive</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$bioarchive->accession}}</li>
        </ol>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
            <tr>
                <td class="col-sm-1">Bioproject Accession</td>
                <td class="col-sm-1"><a class="text-brin" href="/bioprojects/{{ $bioarchive->bioproject->accession }}">{{$bioarchive->bioproject->accession}}</a>
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Bioproject Title</td>
                <td class="col-sm-1">{{$bioarchive->bioproject->title}}
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Bioproject Description</td>
                <td class="col-sm-1">{{$bioarchive->bioproject->description}}
                </td>
            </tr>
            <tr>
                @php
                    $userData = json_decode($bioarchive->user->user_data);
                    $centerName = $userData->pegawaiData->administrative_name ?? 'N/A';
                    $labName = $userData->pegawaiData->affiliate_name ?? 'N/A';    
                @endphp
                <td class="col-sm-1">Center</td>
                <td class="col-sm-1">{{$bioarchive->bioproject->center->name ?? $centerName}}
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Lab</td>
                <td class="col-sm-7">{{$bioarchive->bioproject->user->lab->name ?? $labName}}</td>
            </tr>
            {{-- {{ dd($bioruns) }} --}}
            <tr>
                <td class="col-sm-1">Bioexperiments</td>
                <td class="col-sm-7">
                    <table class="table table-striped table-sm">
                    @foreach ($bioexperiments as $bioexperiment)
                        <tr>
                            <td class="col-sm-1">Biosample</td>
                            <td class="col-sm-7"><a class="text-brin" href="/biosamples/{{$bioexperiment->biosample->accession}}">{{$bioexperiment->biosample->accession}}</a></td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Title</td>
                            <td class="col-sm-7">{{$bioexperiment->title}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Library Source</td>
                            <td class="col-sm-7">{{$bioexperiment->libsource->name}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Library Selection</td>
                            <td class="col-sm-7">{{$bioexperiment->libselection->name}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Library Strategy</td>
                            <td class="col-sm-7">{{$bioexperiment->libstrategy->name}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Instrument</td>
                            <td class="col-sm-7">{{$bioexperiment->instrument->name}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">Library Layout</td>
                            <td class="col-sm-7">{{$bioexperiment->liblayout->name}}</td>
                        </tr>
                        <tr>
                            <td class="col-sm-1">File</td>
                            <td class="col-sm-7">
                                @foreach ($bioruns as $biorun)
                                    {{$biorun->filename}}<br>
                                    {{-- {{Helper::biorunRegex($biorun->filename,$bioarchive->accession, $bioexperiment->alias)}}<br> --}}
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                        
                    </table>
                    <table class="table table-sm">
                        <tr>
                            <td>
                                @if(!$permission_info)
                                <form action="{{ route('button.action') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bioarchive_id" value="{{ $bioarchive->id }}">
                                    <button type="submit" class="btn btn-secondary btn-sm">Request to Download</button>
                                </form>
                                @elseif(!$permission_info->is_approved)
                                <!-- Entry exists but is_agreed/is_approve is false -->
                                    <button type="button" class="btn btn-warning btn-sm" disabled>Waiting for Approval</button>
                                @elseif($permission_info->is_approved)
                                    {{-- <a href="{{ route('download', ['id' => $permission_info->id]) }}" class="btn btn-success btn-sm">Download</a> --}}
                                    <a href="{{ route('folder.index', ['relativePath' => $permission_info->path]) }}" class="btn btn-success btn-sm">Download</a>
                                @endif
                            </td>
                            <td>
                                @if(session('success'))
                                    <p>{{ session('success') }}</p>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Submitter</td>
                <td class="col-sm-7">{{$bioarchive->user->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Submitted at</td>
                <td class="col-sm-7">{{$bioarchive->created_at->format('d-m-Y')}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Published at</td>
                <td class="col-sm-7">{{$bioarchive->published_at === null ? 'None' : $bioarchive->published_at->format('d-m-Y')}}</td>
            </tr>

        </table>
    </div>
</div>
@endsection
