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
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
    <strong> {{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
    <strong> {{session('error')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th class="col-sm-2">Title</th>
                                <td class="col-sm-10">{{$bioproject->title}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Description</th>
                                <td class="col-sm-10">{{$bioproject->description}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Relevance</th>
                                <td class="col-sm-10">{{$relevance->relevance->name}}
                                    @if ($relevance->relevance->id == 7)
                                    &mdash; {{$relevance->description}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Umbrella Projects</th>
                                <td class="col-sm-10">
                                    @isset($umbrella)
                                        <a href="{{ $umbrella->accession }}">{{ $umbrella->accession }}</a> &mdash; {{$umbrella->title}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">External Link</th>
                                <td class="col-sm-10">
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
                                                    <tr>
                                                        <td colspan="2">N/A</td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <th class="col-sm-2">Grant</th>
                                <td class="col-sm-10">
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
                                                <tr>
                                                    <td colspan="3">N/A</td>
                                                </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-2">Consortium</th>
                                <td class="col-sm-10">
                                    @if($bioproject->consortium != null)
                                        {{$bioproject->consortium->name}} &mdash; <a href="https://www.{{ $bioproject->consortium->url }}">{{ $bioproject->consortium->url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-2">Data Type</th>
                                <td class="col-sm-10">
                                    <ul>
                                        @foreach ( $data_types as $key => $value )
                                            <li>{{$value}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>

                            <tr>
                                <th class="col-sm-2">Sample Scope</th>
                                <td class="col-sm-10">{{$bioproject->samplescope->name}}
                                    @if ($bioproject->samplescope->id == 7)
                                        &mdash; {{$sampleScopeBioproject?->description ?? 'N/A'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Material</th>
                                <td class="col-sm-10">{{$material->material->name}}
                                    @if ($material->material->id == 7)
                                    &mdash; {{$material->description}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Capture</th>
                                <td class="col-sm-10">{{$capture->capture->name}}
                                    @if ($capture->capture->id == 6)
                                    &mdash; {{$capture->description}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Methodology</th>
                                <td class="col-sm-10">{{$methodology->methodology->name}}
                                    @if ($methodology->methodology->id == 4)
                                    &mdash; {{$methodology->description}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Organism</th>
                                <td class="col-sm-10">{{$bioproject->organism->name ?? $bioproject->organism_detail['current_scientific_name']['name']}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Novel organism</th>
                                <td class="col-sm-10">
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
                                <th class="col-sm-2">Single biological cell</th>
                                <td class="col-sm-10">{{ $target?->organism_sbc ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Isolate</th>
                                <td class="col-sm-10">{{ $target?->organism_isolate ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Description (Organism)</th>
                                <td class="col-sm-10">{{ $target?->organism_desc ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Celularity</th>
                                <td class="col-sm-10">{{ $target?->celularity?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Reproduction</th>
                                <td class="col-sm-10">{{ $target?->reproduction?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Ploidy</th>
                                <td class="col-sm-10">
                                    {{ $target?->ploidy?->name ?? 'N/A' }}
                                    @if(filled($target?->ploidy_description))
                                        &mdash; {{ $target->ploidy_description }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Haploid genome size</th>
                                <td class="col-sm-10">
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
                                <th class="col-sm-2">Disease</th>
                                <td class="col-sm-10">{{ $target?->phenotypes_disease ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Biotic relationship</th>
                                <td class="col-sm-10">{{ $target?->bioticRelationship?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Trophic level</th>
                                <td class="col-sm-10">{{ $target?->trophicLevel?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Prokaryote morphology</th>
                                <td class="col-sm-10">
                                    <div>Gram: {{ is_null($target?->prokaryote_morphology_gram) ? 'N/A' : ($target->prokaryote_morphology_gram == 1 ? 'Positive' : 'Negative') }}</div>
                                    <div>Motility: {{ is_null($target?->prokaryote_morphology_motility) ? 'N/A' : ($target->prokaryote_morphology_motility == 1 ? 'Yes' : 'No') }}</div>
                                    <div>Enveloped: {{ is_null($target?->prokaryote_morphology_enveloped) ? 'N/A' : ($target->prokaryote_morphology_enveloped == 1 ? 'Yes' : 'No') }}</div>
                                    <div>Endospores: {{ is_null($target?->prokaryote_morphology_endospores) ? 'N/A' : ($target->prokaryote_morphology_endospores == 1 ? 'Yes' : 'No') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Habitat</th>
                                <td class="col-sm-10">{{ $target?->habitat?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Salinity</th>
                                <td class="col-sm-10">{{ $target?->salinity?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Oxygen requirement</th>
                                <td class="col-sm-10">{{ $target?->oxygenReq?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Temperature range</th>
                                <td class="col-sm-10">{{ $target?->tempRange?->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Optimum temperature</th>
                                <td class="col-sm-10">{{ $target?->optimum_temp ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Organism Replicon</th>
                                <td class="col-sm-10">
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
                                <th class="col-sm-2">Publication</th>
                                <td class="col-sm-10">
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
                                                    <tr>
                                                        <td colspan="2">N/A</td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Center</th>
                                {{-- <td class="col-sm-10">{{$bioproject->center->name}}</td> --}}
                                
                                <td class="col-sm-10">
                                    @php
                                        $userData = json_decode(auth()->user()->user_data);
                                    @endphp
                                    {{ $bioproject->center->name ?? $userData->pegawaiData->administrative_name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Lab</th>
                                {{-- <td class="col-sm-10">{{$bioproject->user->lab->name}}</td> --}}
                                <td class="col-sm-10">{{$bioproject->lab->name ?? $userData->pegawaiData->affiliate_name}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Submitter</th>
                                <td class="col-sm-10">{{$bioproject->user->name}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Submitted at</th>
                                <td class="col-sm-10">{{$bioproject->created_at->format('d-m-Y')}}</td>
                            </tr>
                            <tr>
                                <th class="col-sm-2">Published at</th>
                                <td class="col-sm-10">{{$bioproject->published_at === null ? 'N/A' : $bioproject->published_at->format('d-m-Y')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-4">
            @canany(['isSuperAdmin','isAdmin'])
                @if ($bioproject->status ===1)
                    <form action="/dashboard/curator/bioprojects/{{$bioproject->accession}}" class="row p-2" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="action" value="assignedToCurator">
                        <label class="fw-bolder" for="target">{{$bioproject->curator_id === null ? 'Assign' : 'Assigned' }} to:</label>
                        <div class="col-8">
                            <select class="form-select" name="target" id="target">
                                <option value="" disabled selected >Select curator</option>
                                @foreach ($curators as $curator)
                                <option value="{{$curator->id}}" {{$bioproject->curator_id == $curator->id ? 'selected' : ''}}>{{$curator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4 d-grid gap-2">
                            <button type="button" id="btnModalAssign" class="btn btn-primary btn-block border-0" data-bs-toggle="modal" data-bs-target="#modalAssign" disabled>Save</button>
                        </div>
                        <div class="modal fade" id="modalAssign" tabindex="-1" aria-labelledby="modalAssignLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAssignLabel">Assign to ...</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">Insert Description (Optional)</label>
                                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary " data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            @endcanany
            @can('isCurator')
            @if ($bioproject->status===2)
                <form action="/dashboard/curator/bioprojects/{{$bioproject->accession}}" class="row p-2" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="target" value="{{$bioproject->user_id}}">
                    <label class="fw-bolder" for="action">Action:</label>
                    <div class="col-8">
                        <select class="form-select" name="action" id="action">
                            <option value="approved">Approve</option>
                            <option value="returnedToSubmitter">Return to submitter</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="col-4 d-grid gap-2">
                        <button type="button" id="btnModalActionCurator" class="btn btn-primary btn-block border-0" data-bs-toggle="modal" data-bs-target="#modalActionCurator">Save</button>
                    </div>
                    <div class="modal fade" id="modalActionCurator" tabindex="-1" aria-labelledby="modalActionCuratorLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalActionCuratorLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Insert Description (Optional)</label>
                                        <textarea class="form-control" id="descCurator" name="desc" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            @endcan
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
@push('js')
    <script>
        $(document).ready(function() {
            const modalAssign = document.getElementById('modalAssign')
            if (modalAssign !== null) {
                $('#target').select2({
                    theme: 'bootstrap-5',
                    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                    placeholder: 'Select curator'
                })
                $('#target').on('change', function(e) {
                    document.getElementById('btnModalAssign').disabled = false
                })
                const inputDesc = document.getElementById('desc')
                const curatorId = document.getElementById('target')
                const modalAssignLabel = document.getElementById('modalAssignLabel')

                modalAssign.addEventListener('show.bs.modal', function () {
                    modalAssignLabel.innerHTML = "Assign to "+ curatorId.options[curatorId.selectedIndex].text +' ?'
                })
                modalAssign.addEventListener('shown.bs.modal', function () {
                    inputDesc.focus()
                })
            } else {
                if ('{{!$bioproject->draft && $bioproject->published_at === null}}') {
                    const modalActionCurator= document.getElementById('modalActionCurator')
                    const descCurator = document.getElementById('descCurator')
                    const action = document.getElementById('action')
                    const modalActionCuratorLabel = document.getElementById('modalActionCuratorLabel')
                    modalActionCurator.addEventListener('show.bs.modal', function () {
                        modalActionCuratorLabel.innerHTML = action.options[action.selectedIndex].text + " ({{$bioproject->title}})?"
                    })
                    modalActionCurator.addEventListener('shown.bs.modal', function () {
                        descCurator.focus()
                    })
                }
            }
        })
    </script>
@endpush
