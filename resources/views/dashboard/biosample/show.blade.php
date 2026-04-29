@extends('dashboard.layouts.main')
@section('title', 'Biosample ' . $biosample->accession)

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
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <tr>
                                <td class="col-sm-1">Title</td>
                                <td class="col-sm-7">{{$biosample->title}}</td>
                            </tr>
                            <tr>
                                <td class="col-sm-1">Organism</td>
                                @isset($biosample->organism_detail['current_scientific_name']['name'])
                                <td class="col-sm-7">
                                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewOrganismDetailModal">
                                        {{$biosample->organism_detail['tax_id'] ?? " - "}} - {{$biosample->organism_detail['current_scientific_name']['name'] ?? 'None'}}
                                    </a>
                                </td>
                                @else
                                <td class="col-sm-7">{{$organism->name}}</td>
                                @endisset
                            </tr>
                            <tr>
                                <td class="col-sm-1">Bioproject</td>
                                <td class="col-sm-7">
                                    <a href="{{auth()->id() == $biosample->bioproject->user_id ? '/dashboard' : '' }}/bioprojects/{{ $biosample->bioproject->accession }}" target="_blank" rel="noopener noreferrer">
                                        {{$biosample->bioproject->accession . " - " . $biosample->bioproject->title ?? 'None'}}
                                    </a>
                                </td>
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
                                <td class="col-sm-1">External Links</td>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-8">Description</th>
                                                        <th class="col-sm-4">URL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($externallinks as $link)
                                                        <tr>
                                                            <td class="col-sm-8">{{$link->link_description ?? 'None'}}</td>
                                                            <td class="col-sm-4">
                                                                @if(!empty($link->link_url))
                                                                    <a href="{{$link->link_url}}" target="_blank" rel="noopener noreferrer">{{$link->link_url}}</a>
                                                                @else
                                                                    None
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2">None</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="col-sm-1 align-top">Sample Attribute</td>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                @forelse ($sample_attr as $item)
                                                    @if ($item->attributesample->attr_name !== 'organism' && $item->attributesample->attr_name !== 'bioproject_id')
                                                    <tr>
                                                        <td class="col-sm-3">{{$item->attributesample->attr_text}}</td>
                                                        <td class="col-sm-3">
                                                            @if ($item->attributesample->attr_name === 'taxonomy_id')
                                                                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewOrganismDetailModal">
                                                                    {{$biosample->organism_detail['tax_id'] ?? 'None'}}
                                                                </a>
                                                            @else
                                                            {{$item->value}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @empty
                                                None
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-sm-1">Center</td>
                                <td class="col-sm-1">
                                    @php
                                        $userData = json_decode(auth()->user()->user_data);
                                    @endphp
                                    {{ $biosample->center->name ?? $userData->pegawaiData->administrative_name }}
                                </td>
                                {{-- <td class="col-sm-1">{{auth()->user()->center_id}}</td> --}}
                            </tr>
                            <tr>
                                <td class="col-sm-1">Lab</td>
                                <td class="col-sm-7">{{$biosample->lab->name ?? $userData->pegawaiData->affiliate_name}}</td>
                                {{-- <td class="col-sm-7">{{auth()->user()->lab_id}}</td> --}}
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
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>History</h5>
                </div>
                <div class="card-body">
                    <ul class="simple-timeline mb-0">
                        @if ($biosample->published_at !== null)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-dot timeline-dot-success"></span>
                            <div class="timeline-time">
                                <div class="timeline-header-section mb-2">
                                    <h6 class="mb-0">Published</h6>
                                    <small class="fw-lighter mb-1">{{$biosample->published_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    @if ($biosample->hold_release)
                                        This biosample has been published but is not yet publicly accessible because it is on hold.
                                    @else
                                        This biosample has been published and is now publicly accessible.
                                    @endif
                                </p>
                            </div>
                        </li>
                        @endif
                        @foreach ($histories as $history)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-dot timeline-dot-primary"></span>
                            <div class="timeline-time">
                                <div class="timeline-header-section mb-2">
                                    <h6 class="mb-0">{{preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($history->action))}} by {{explode(' ', trim($history->creator->name))[0]}}</h6>
                                    <small class="fw-light">{{$history->created_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                {{$history->desc ?? 'No additional description provided.'}}
                                </p>
                            </div>
                        </li>
                        @endforeach
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-dot timeline-dot-info"></span>
                            <div class="timeline-time">
                                <div class="timeline-header-section mb-2">
                                    <h6 class="mb-0">Created</h6>
                                    <small class="fw-light">{{$biosample->created_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    Successfully created by {{explode(' ', trim($biosample->user->name))[0]}}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>

@include('dashboard.layouts.organismdetailmodal')
@endsection

@push('js')
<script>
    window.currentOrganismDetail = @json($biosample->organism_detail ?? []);
</script>

@endpush