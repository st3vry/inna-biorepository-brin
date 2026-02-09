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
    <!-- <h1 class="h2"> Accession : {{$bioproject->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioprojects">Bioproject</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioproject->accession}}</li>
    </ol>
</div>
<div class="row">
    <div class="table-responsive col-md-8">
        <table class="table table-striped table-sm">
            <tr>
                <td class="col-sm-1">Title</td>
                <td class="col-sm-7">{{$bioproject->title}}</td>
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
                <td class="col-sm-1">Umbrella Projects</td>
                @isset($umbrella)
                <td class="col-sm-7"><a href="{{ $umbrella->accession }}">{{ $umbrella->accession }}</a> &mdash; {{$umbrella->title}}</td>
                @else
                <td class="col-sm-7">N/A</td>
                @endisset
            </tr>

            <tr>
                <td class="col-sm-1">External Link</td>
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
                <td class="col-sm-1">Grant</td>
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
                <td class="col-sm-1">Consortium</td>
                @isset($consortium)
                <td class="col-sm-7">{{$bioproject->consortium->name}} &mdash; <a href="https://www.{{ $bioproject->consortium->url }}">{{ $bioproject->consortium->url }}</a></td>
                @else
                <td class="col-sm-7">N/A</td>
                @endisset
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
                <td class="col-sm-1">Sample Scope</td>
                <td class="col-sm-7">{{$bioproject->samplescope->name}}
                    @if ($bioproject->samplescope->id == 7)
                    &mdash; {{$sampleScopeBioproject?->description ?? 'N/A'}}
                    @endif 
                </td>
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
                <td class="col-sm-1">Organism</td>
                <td class="col-sm-7">{{$bioproject->organism->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-3">Novel organism</td>
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
                <td>Single biological cell</td>
                <td>{{ $target?->organism_sbc ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Isolate</td>
                <td>{{ $target?->organism_isolate ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $target?->organism_desc ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Celularity</td>
                <td>{{ $target?->celularity?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Reproduction</td>
                <td>{{ $target?->reproduction?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Ploidy</td>
                <td>
                    {{ $target?->ploidy?->name ?? 'N/A' }}
                    @if(filled($target?->ploidy_description))
                        &mdash; {{ $target->ploidy_description }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Haploid genome size</td>
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
                <td>Disease</td>
                <td>{{ $target?->phenotypes_disease ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Biotic relationship</td>
                <td>{{ $target?->bioticRelationship?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Trophic level</td>
                <td>{{ $target?->trophicLevel?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Prokaryote morphology</td>
                <td>
                    <div>Gram: {{ is_null($target?->prokaryote_morphology_gram) ? 'N/A' : ($target->prokaryote_morphology_gram == 1 ? 'Positive' : 'Negative') }}</div>
                    <div>Motility: {{ is_null($target?->prokaryote_morphology_motility) ? 'N/A' : ($target->prokaryote_morphology_motility == 1 ? 'Yes' : 'No') }}</div>
                    <div>Enveloped: {{ is_null($target?->prokaryote_morphology_enveloped) ? 'N/A' : ($target->prokaryote_morphology_enveloped == 1 ? 'Yes' : 'No') }}</div>
                    <div>Endospores: {{ is_null($target?->prokaryote_morphology_endospores) ? 'N/A' : ($target->prokaryote_morphology_endospores == 1 ? 'Yes' : 'No') }}</div>
                </td>
            </tr>
            <tr>
                <td>Habitat</td>
                <td>{{ $target?->habitat?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Salinity</td>
                <td>{{ $target?->salinity?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Oxygen requirement</td>
                <td>{{ $target?->oxygenReq?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Temperature range</td>
                <td>{{ $target?->tempRange?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Optimum temperature</td>
                <td>{{ $target?->optimum_temp ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Organism Replicon</td>
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
                <td class="col-sm-1">Publication</td>
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
                <td class="col-sm-1">Center</td>
                <td class="col-sm-7">
                    @php
                        $userData = json_decode(auth()->user()->user_data);
                    @endphp
                    {{ $bioproject->center->name ?? $userData->pegawaiData->administrative_name }}
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Lab</td>
                <td class="col-sm-7">{{$bioproject->lab->name ?? $userData->pegawaiData->affiliate_name}}</td>
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
                <td class="col-sm-7">{{$bioproject->published_at === null ? 'N/A' : $bioproject->published_at->format('d-m-Y')}}</td>
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
                        @if ($bioproject->published_at !== null)
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">Published</strong>
                            <p class="fw-lighter mb-1">{{$bioproject->published_at->format('j F Y H:i')}}</p>
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
                            <strong class="fw-bolder">Bioproject Created </strong>
                            <p class="fw-lighter mb-1">{{$bioproject->created_at->format('j F Y H:i')}}</p>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection