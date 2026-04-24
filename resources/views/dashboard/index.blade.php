@extends('dashboard.layouts.main')
@section('title', "Welcome, " . (str_word_count(auth()->user()->name) > 1 ? explode(' ', trim(auth()->user()->name))[0] . ' ' . last(explode(' ', trim(auth()->user()->name))) : auth()->user()->name) . "!")

@section('container')
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
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioproject_pub_count }} of {{ $bioproject_count }} <small class="fs-12">Projects Published</small></h3>
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{$bioproject_count > 0 && number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $bioproject_count > 0 ? number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) : 0 }}%
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                            <p class="mb-0 text-muted">{{ $bioproject_hold_count }} Bioprojects on Hold</p>
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

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $biosample_pub_count }} of {{ $biosample_count }} <small class="fs-12">Samples Published</small></h3>

                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{$biosample_count > 0 && number_format(($biosample_pub_count / $biosample_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $biosample_count > 0 ? number_format(($biosample_pub_count / $biosample_count) * 100, 2) : 0 }}%
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                            <p class="mb-0 text-muted">{{ $biosample_hold_count }} Biosamples on Hold</p>
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

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioarchive_pub_count }} of {{ $bioarchive_count }} <small class="fs-12">Archives Published</small></h3>

                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{$bioarchive_count > 0 && number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $bioarchive_count > 0 ? number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) : 0 }}%
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                            <p class="mb-0 text-muted">{{ $bioarchive_hold_count }} BioArchives on Hold</p>
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

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{$bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count}} of {{$bioproject_count + $biosample_count + $bioarchive_count}} <small class="fs-12">Published</small></h3>
                            
                            <div class="d-flex align-items-center">
                                <span class="me-2 rounded-2 badge fs-12 {{ ($bioproject_count + $biosample_count + $bioarchive_count) > 0 && number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ ($bioproject_count + $biosample_count + $bioarchive_count) > 0 ? number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) : 0 }}%
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                            <p class="mb-0 text-muted">{{$bioproject_hold_count + $biosample_hold_count + $bioarchive_hold_count}} Total on Hold</p>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection