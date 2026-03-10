@extends('dashboard.layouts.main')
@section('title', "Welcome, " . (str_word_count(auth()->user()->name) > 1 ? explode(' ', trim(auth()->user()->name))[0] . ' ' . last(explode(' ', trim(auth()->user()->name))) : auth()->user()->name) . "!")

@section('container')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
body{
    /* margin-top:20px; */
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

a {
  color: white;
}

a:hover {
  color: salmon;
} 

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
} 
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row">
        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-secondary-subtle p-2 me-2">
                                <iconify-icon icon="tabler:list" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/bioprojects">BioProjects</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioproject_pub_count }} of {{ $bioproject_count }} <small class="fs-12">Projects Published</small></h3>
                            
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-primary-subtle p-2 me-2">
                                <iconify-icon icon="tabler:layers-subtract" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/biosamples">BioSamples</a>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $biosample_pub_count }} of {{ $biosample_count }} <small class="fs-12">Samples Published</small></h3>

                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{number_format(($biosample_pub_count / $biosample_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ number_format(($biosample_pub_count / $biosample_count) * 100, 2) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-success-subtle p-2 me-2">
                                <iconify-icon icon="tabler:server" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/bioarchives">BioArchives</a>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioarchive_pub_count }} of {{ $bioarchive_count }} <small class="fs-12">Archives Published</small></h3>

                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle bg-danger-subtle p-2 me-2">
                                <iconify-icon icon="tabler:circle-check" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                            </div>
                            <p class="mb-0 text-dark fs-16">Total Published</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{$bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count}} of {{$bioproject_count + $biosample_count + $bioarchive_count}} <small class="fs-12">Published</small></h3>
                            
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection