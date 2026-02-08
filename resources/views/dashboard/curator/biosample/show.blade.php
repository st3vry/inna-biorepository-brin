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

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/curator/biosamples">Curator Biosample</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$biosample->accession}}</li>
    </ol>
</div>
<div class="row">
    <div class="table-responsive col-md-8">
        <h3>{{$biosample->title}}</h3>
        <table class="table table-lg">
            <tr>
                <th class="col-sm-2">Organism</th>
                <td class="col-sm-10">{{$biosample->organism->name}}</td>
            </tr>
            <tr>
                <th class="col-sm-2">Sample Type</th>
                <td class="col-sm-10">{{$biosample->sampletype->name}}</td>
            </tr>
            <tr>
                <th class="col-sm-2">Description</th>
                <td class="col-sm-10">{{$biosample->description}}</td>
            </tr>
            <tr>
                <th class="col-sm-1">External Links</th>
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
                <th class="col-sm-2">Sample Attribute</th>
                <td class="col-sm-10">
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <table class="table table-striped table-sm">
                                @forelse ($sample_attr as $item)
                                    <tr>
                                         <td class="col-sm-3">{{$item->attributesample->attr_text}}</td>
                                        <td class="col-sm-3">{{$item->value}}</td>
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
                <th class="col-sm-2">Center</th>
                <td class="col-sm-10">
                    @php
                        $userData = json_decode(auth()->user()->user_data);
                    @endphp
                    {{ $biosample->center->name ?? $userData->pegawaiData->administrative_name }}
                </td>
                {{-- <td class="col-sm-10">{{$biosample->center_id}}</td> --}}
            </tr>
            <tr>
                <th class="col-sm-2">Lab</th>
                <td class="col-sm-10">{{$biosample->lab->name ?? $userData->pegawaiData->affiliate_name}}</td>
                {{-- <td class="col-sm-10">{{$biosample->user->affiliate}}</td> --}}
            </tr>
            <tr>
                <th class="col-sm-2">Submitter</th>
                <td class="col-sm-10">{{$biosample->user->name}}</td>
            </tr>
            {{-- <tr>
                <th class="col-sm-1">Submitted at</th>
                <td class="col-sm-7">{{$biosample->created_at->format('d-m-Y')}}</td>
            </tr>
            <tr>
                <th class="col-sm-1">Published at</th>
                <td class="col-sm-7">{{$biosample->published_at === null ? 'None' : $biosample->published_at->format('d-m-Y')}}</td>
            </tr> --}}
    
        </table>
    </div>
    
    <div class="col-md-4">
        @canany(['isSuperAdmin','isAdmin'])
            @if ($biosample->status ===1)
                <form action="/dashboard/curator/biosamples/{{$biosample->accession}}" class="row p-2" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="action" value="assignedToCurator">
                    <label class="fw-bolder" for="target">{{$biosample->curator_id === null ? 'Assign' : 'Assigned' }} to:</label>
                    <div class="col-8">
                        <select class="form-select" name="target" id="target">
                            <option value="" disabled selected >Select curator</option>
                            @foreach ($curators as $curator)
                            <option value="{{$curator->id}}" {{$biosample->curator_id == $curator->id ? 'selected' : ''}}>{{$curator->name}}</option>
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
            @if ($biosample->status===2)
                <form action="/dashboard/curator/biosamples/{{$biosample->accession}}" class="row p-2" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="target" value="{{$biosample->user_id}}">
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
        <div class="card m-2">
            <div class="card-header">
                <h6>History</h6>
            </div>
            <div class="card-body">
                <section>
                    <ul class="timeline">
                        @if ($biosample->published_at !== null)
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">Published</strong>
                            <p class="fw-lighter mb-1">{{$biosample->published_at->format('j F Y H:i')}}</p>
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
                            <strong class="fw-bolder">Biosample Created </strong>
                            <p class="fw-lighter mb-1">{{$biosample->created_at->format('j F Y H:i')}}</p>
                        </li>
                    </ul>
                </section>
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
                if ('{{!$biosample->draft && $biosample->published_at === null}}') {
                    const modalActionCurator= document.getElementById('modalActionCurator')
                    const descCurator = document.getElementById('descCurator')
                    const action = document.getElementById('action')
                    const modalActionCuratorLabel = document.getElementById('modalActionCuratorLabel')
                    modalActionCurator.addEventListener('show.bs.modal', function () {
                        modalActionCuratorLabel.innerHTML = action.options[action.selectedIndex].text + " ({{$biosample->title}})?"
                    })
                    modalActionCurator.addEventListener('shown.bs.modal', function () {
                        descCurator.focus()
                    })
                }
                
            }           
        })
    </script>
@endpush