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
        <li class="breadcrumb-item"><a href="/dashboard/curator/biosample">Curator Biosample</a></li>
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
                <th class="col-sm-2">Center</th>
                <td class="col-sm-10">{{$biosample->center->name}}</td>
            </tr>
            <tr>
                <th class="col-sm-2">Lab</th>
                <td class="col-sm-10">{{$biosample->user->lab->name}}</td>
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
        <div class="card m-2">
            <div class="card-header">
                <h6>History</h6>
            </div>
            <div class="card-body">
              <section>
                <ul class="timeline">
                  <li class="timeline-item mb-5">
                    <strong class="fw-bolder">Our company starts its operations</strong>
                    <p class="fw-lighter mb-1">11 March 2020</p>
                    <p class="text-muted">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit
                      necessitatibus adipisci, ad alias, voluptate pariatur officia
                      repellendus repellat inventore fugit perferendis totam dolor
                      voluptas et corrupti distinctio maxime corporis optio?
                    </p>
                </ul>
              </section>
            </div>
        </div>
    </div>
</div>

    

@endsection