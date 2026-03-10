@extends('dashboard.layouts.main')
@section('title', 'Bioproject - ' . $bioproject->accession)

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
                                <th colspan="2"><h5>General Information</h5></th>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Title</th>
                                <td class="col-sm-7">{{$bioproject->title}}</td>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Description</th>
                                <td class="col-sm-7">{{$bioproject->description}}</td>
                            </tr>
                            
                            <tr>
                                <th class="col-sm-1">Relevance</th>
                                <td class="col-sm-7">{{$relevance->relevance->name}}
                                    @if ($relevance->relevance->id == 7)
                                    &mdash; {{$relevance->description}}
                                    @endif </td>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Umbrella Projects</th>
                                @isset($umbrella)
                                <td class="col-sm-7"><a href="{{ $umbrella->accession }}">{{ $umbrella->accession }}</a> &mdash; {{$umbrella->title}}</td>
                                @else
                                <td class="col-sm-7">N/A</td>
                                @endisset
                            </tr>

                            <tr>
                                <th class="col-sm-1">External Link</th>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <th>Link</th>
                                                    <th>Description</th>
                                                </thead>
                                                @forelse ( $externallinks as $externallink )
                                                <tr>
                                                    <td class="col-sm-3"><a href="{{$externallink->link_url}}" target=_blank>{{$externallink->link_url}}</td>
                                                    <td class="col-sm-3">{{$externallink->link_description}}</td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="2">N/A</td></tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Grant</th>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <th>Grant Title</th>
                                                    <th>Grant Program</th>
                                                    <th>Funding Agency</th>
                                                </thead>
                                                @forelse ( $grants as $grant )
                                                <tr>
                                                    <td class="col-sm-3">{{$grant->grant_title}}</td>
                                                    <td class="col-sm-3">{{$grant->grant_program}}</td>
                                                    <td class="col-sm-3">{{$grant->fundagency->name}}</td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="3">N/A</td></tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Consortium</th>
                                @isset($consortium)
                                <td class="col-sm-7">{{$bioproject->consortium->name}} &mdash; <a href="https://www.{{ $bioproject->consortium->url }}">{{ $bioproject->consortium->url }}</a></td>
                                @else
                                <td class="col-sm-7">N/A</td>
                                @endisset
                            </tr>


                            <tr>
                                <th colspan="2"><br><h5>Project Type</h5></th>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Data Type</th>
                                <td class="col-sm-7">
                                    <ul>
                                        @foreach ( $data_types as $key => $value )
                                        <li>{{$value}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-1">Sample Scope</th>
                                <td class="col-sm-7">{{$bioproject->samplescope->name}}
                                    @if ($bioproject->samplescope->id == 7)
                                    &mdash; {{$sampleScopeBioproject?->description ?? 'N/A'}}
                                    @endif 
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Material</th>
                                <td class="col-sm-7">{{$material->material->name}}
                                    @if ($material->material->id == 7)
                                    &mdash; {{$material->description}}
                                    @endif </td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Capture</th>
                                <td class="col-sm-7">{{$capture->capture->name}}
                                    @if ($capture->capture->id == 6)
                                    &mdash; {{$capture->description}}
                                    @endif </td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Methodology</th>
                                <td class="col-sm-7">{{$methodology->methodology->name}}
                                    @if ($methodology->methodology->id == 4)
                                    &mdash; {{$methodology->description}}
                                    @endif </td>
                            </tr>
                            <tr>
                                <th colspan="2"><br><h5>Organism Information</h5></th>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Organism</th>
                                <td class="col-sm-7">{{$bioproject->organism->name}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">Novel organism</th>
                                <td class="col-sm-9">
                                    @if(is_null($target?->organism_novel))
                                        N/A
                                    @else
                                        {{ $target->organism_novel == 1 ? 'Yes' : 'No' }}
                                    @endif
                                    @if(filled($target?->organism_novel_description))
                                        &mdash; {{ $target->organism_novel_description }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Single biological cell</th>
                                <td>{{ $target?->organism_sbc ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Isolate</th>
                                <td>{{ $target?->organism_isolate ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $target?->organism_desc ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Celularity</th>
                                <td>{{ $target?->celularity?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Reproduction</th>
                                <td>{{ $target?->reproduction?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Ploidy</th>
                                <td>
                                    {{ $target?->ploidy?->name ?? 'N/A' }}
                                    @if(filled($target?->ploidy_description))
                                        &mdash; {{ $target->ploidy_description }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Haploid genome size</th>
                                <td>
                                    @if(filled($target?->haploid_genome_size))
                                        {{ $target->haploid_genome_size }}
                                        @if($target?->genomeSize)
                                            {{ $target->genomeSize->name }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Disease</th>
                                <td>{{ $target?->phenotypes_disease ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Biotic relationship</th>
                                <td>{{ $target?->bioticRelationship?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Trophic level</th>
                                <td>{{ $target?->trophicLevel?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Prokaryote morphology</th>
                                <td>
                                    <div>Gram: {{ is_null($target?->prokaryote_morphology_gram) ? 'N/A' : ($target->prokaryote_morphology_gram == 1 ? 'Positive' : 'Negative') }}</div>
                                    <div>Motility: {{ is_null($target?->prokaryote_morphology_motility) ? 'N/A' : ($target->prokaryote_morphology_motility == 1 ? 'Yes' : 'No') }}</div>
                                    <div>Enveloped: {{ is_null($target?->prokaryote_morphology_enveloped) ? 'N/A' : ($target->prokaryote_morphology_enveloped == 1 ? 'Yes' : 'No') }}</div>
                                    <div>Endospores: {{ is_null($target?->prokaryote_morphology_endospores) ? 'N/A' : ($target->prokaryote_morphology_endospores == 1 ? 'Yes' : 'No') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Habitat</th>
                                <td>{{ $target?->habitat?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Salinity</th>
                                <td>{{ $target?->salinity?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Oxygen requirement</th>
                                <td>{{ $target?->oxygenReq?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Temperature range</th>
                                <td>{{ $target?->tempRange?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Optimum temperature</th>
                                <td>{{ $target?->optimum_temp ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Organism Replicon</th>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm mb-0">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Location</th>
                                                    <th>Size</th>
                                                    <th>Unit</th>
                                                </thead>
                                                @forelse ($replicons as $replicon)
                                                    <tr>
                                                        <td class="col-sm-3">{{ $replicon->name ?? 'N/A' }}</td>
                                                        <td class="col-sm-2">{{ $replicon->replType?->name ?? 'N/A' }}</td>
                                                        <td class="col-sm-2">{{ $replicon->replLocation?->name ?? 'N/A' }}</td>
                                                        <td class="col-sm-2">{{ $replicon->size ?? 'N/A' }}</td>
                                                        <td class="col-sm-3">{{ $replicon->genomeSize?->name ?? 'N/A' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">N/A</td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Publication</th>
                                <td class="col-sm-7">
                                    <div class="card shadow-sm mb-2">
                                        <div class="card-body">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <th>Title</th>
                                                    <th>PubMed/DOI</th>
                                                </thead>
                                                @forelse ( $pubs as $pub )
                                                <tr>
                                                    <td class="col-sm-3">{{$pub->article_title}}</td>
                                                    <td class="col-sm-3">
                                                        @if($pub->pub_identifier_id == 1)
                                                            <a href="https://www.doi.org/{{$pub->pub_id}}" target="_blank">{{$pub->pub_id}} </a> 
                                                        @else
                                                            <a href="https://pubmed.ncbi.nlm.nih.gov/{{$pub->pub_id}}" target="_blank">{{$pub->pub_id}} </a> 
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="2">N/A</td></tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2"><br><h4>Submission Information</h4></th>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Center</th>
                                <td class="col-sm-7">
                                    @php
                                        $userData = json_decode(auth()->user()->user_data);
                                    @endphp
                                    {{ $bioproject->center->name ?? $userData->pegawaiData->administrative_name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Lab</th>
                                <td class="col-sm-7">{{$bioproject->lab->name ?? $userData->pegawaiData->affiliate_name}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Submitter</th>
                                <td class="col-sm-7">{{$bioproject->user->name}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Submitted at</th>
                                <td class="col-sm-7">{{$bioproject->created_at->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-1">Published at</th>
                                <td class="col-sm-7">{{$bioproject->published_at === null ? 'N/A' : $bioproject->published_at->format('d-m-Y')}}</td>
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
                        @if ($bioproject->published_at !== null)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-dot timeline-dot-success"></span>
                            <div class="timeline-time">
                                <div class="timeline-header-section mb-2">
                                    <h6 class="mb-0">Published</h6>
                                    <small class="fw-light">{{$bioproject->published_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    @if ($bioproject->hold_release)
                                        This bioproject has been published but is not yet publicly accessible because it is on hold.
                                    @else
                                        This bioproject has been published and is now publicly accessible.
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
                                    <small class="fw-light">{{$bioproject->created_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    Successfully created by {{explode(' ', trim($bioproject->user->name))[0]}}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection