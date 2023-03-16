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
        <li class="breadcrumb-item"><a href="/dashboard/curator/bioprojects">Curator Bioproject</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioproject->accession}}</li>
    </ol>
</div>
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
<div class="row">
    <div class="table-responsive col-md-8">
        <h3>{{$bioproject->title}}</h3>
        <table class="table table-lg">
            <tr>
                <th class="col-sm-2">Umbrella Projects</th>
                @isset($umbrella)
                <td class="col-sm-10"><a href="{{ $umbrella->accession }}">{{ $umbrella->accession }}</a> &mdash; {{$umbrella->title}}</td>
                @else
                <td class="col-sm-10">Not Assigned</td>
                @endisset
            </tr>
            <tr>
                <th class="col-sm-2">Consortium</th>
                @isset($umbrella)
                <td class="col-sm-10">{{$bioproject->consortium->name}} &mdash; <a href="https://www.{{ $umbrella->consortium->url }}">{{ $umbrella->consortium->url }}</a></td>
                @else
                <td class="col-sm-10">Not Assigned</td>
                @endisset
            </tr>
            <tr>
                <th class="col-sm-2">Organism</th>
                <td class="col-sm-10">{{$bioproject->organism->name}}</td>
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
                    @endif </td>
            </tr>
            <tr>
                <th class="col-sm-2">Material</th>
                <td class="col-sm-10">{{$material->material->name}}
                    @if ($material->material->id == 7)
                    &mdash; {{$material->description}}
                    @endif </td>
            </tr>
            <tr>
                <th class="col-sm-2">Capture</th>
                <td class="col-sm-10">{{$capture->capture->name}}
                    @if ($capture->capture->id == 6)
                    &mdash; {{$capture->description}}
                    @endif </td>
            </tr>
            <tr>
                <th class="col-sm-2">Methodology</th>
                <td class="col-sm-10">{{$methodology->methodology->name}}
                    @if ($methodology->methodology->id == 4)
                    &mdash; {{$methodology->description}}
                    @endif </td>
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
                                None
                                @endforelse
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            
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
                                None
                                @endforelse
                            </table>
                        </div>
                    </div>
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
                                None
                                @endforelse
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
    
            <tr>
                <th class="col-sm-2">Sample Scope</th>
                <td class="col-sm-10">{{$bioproject->samplescope->name}}</td>
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
                <th class="col-sm-2">Center</th>
                <td class="col-sm-10">{{$bioproject->center->name}}</td>
            </tr>
            <tr>
                <th class="col-sm-2">Lab</th>
                <td class="col-sm-10">{{$bioproject->user->lab->name}}</td>
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
                <td class="col-sm-10">{{$bioproject->published_at === null ? 'None' : $bioproject->published_at->format('d-m-Y')}}</td>
            </tr>
    
        </table>
    </div>
    <div class="col-md-4">
        @canany(['isSuperAdmin','isAdmin'])
            <form action="/dashboard/curator/bioprojects/{{$bioproject->accession}}" class="row p-2" method="post" class="d-inline">
                @method('put')
                @csrf
<<<<<<< HEAD
                <input type="hidden" name="action" value="assignToCurator">
                <label class="fw-bolder" for="curator_id">Assigned to:</label>
=======
                <input type="hidden" name="action" value="assignedToCurator">
                <label class="fw-bolder" for="target">{{$bioproject->curator_id === null ? 'Assign' : 'Assigned' }} to:</label>
>>>>>>> cb602c39fce0dfde8adc02e2372dcbd607bb805e
                <div class="col-8">
                    <select class="form-select" name="curator_id" id="curator_id">
                        <option value="" disabled selected >Select curator</option>
                        @foreach ($curators as $curator)
                        <option value="{{$curator->id}}" {{$bioproject->curator_id == $curator->id ? 'selected' : ''}}>{{$curator->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 d-grid gap-2">
                    <button class="btn btn-primary btm-block border-0 " onclick="return confirm('Are you sure ?')">Save</button>
                </div>
            </form>
        @endcanany
        <div class="card m-2">
            <div class="card-header">
                <h6>History</h6>
            </div>
            <div class="card-body">
                <section>
                    <ul class="timeline">
                        @foreach ($histories as $history)
                            <li class="timeline-item mb-5">
                                <strong class="fw-bolder">{{$history->action}}</strong>
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
@push('js')
    <script>
        $(document).ready(function() {
            $('#curator_id').select2({
                theme: 'bootstrap-5',
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: 'Select curator'
            })
        })
    </script>
@endpush
