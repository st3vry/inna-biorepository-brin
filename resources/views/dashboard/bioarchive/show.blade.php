@extends('dashboard.layouts.main')

@push('css')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
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
    <!-- <h1 class="h2"> Accession : {{$bioarchive->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/bioarchives">Bioarchives</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioarchive->accession}}</li>
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
        <table class="table table-sm">
            <tr>
                <td>Bioproject Accession </td>
                <td>:</td>
                <td class="col-sm-10"><strong>{{$bioarchive->bioproject->accession}}</strong></td>
            </tr>
            <tr>
                <td>Biosample Accession </td>
                <td>:</td>
                <td class="col-sm-10">
                    <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                        @foreach ($biosample_id as $item => $value)
                        <tr>
                            <td>
                                {{\App\Models\Biosample::select('accession')->where('id', $value)->pluck('accession')->first();}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
               </td>
            </tr>
            <tr>
                <td>Bioexperiment </td>
                <td>:</td>
                <td class="col-sm-10">
                    <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                        @foreach ($bioexperiment as $item => $value)
                        <tr>
                            <td><strong>Biosample</strong></td>
                            <td><strong>{{\App\Http\Controllers\DashboardBioarchiveController::biosampleName($value['biosample_id'])}}</strong></td>
                        </tr>
                        <tr>
                            <td>Alias</td>
                            <td>{{ $value['alias'] }}</td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $value['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Library Name</td>
                            <td>{{ $value['libname'] }}</td>
                        </tr>
                        <tr>
                            <td>Library Source</td>
                            <td>{{\App\Http\Controllers\DashboardBioarchiveController::getLibSourceName($value['libsource_id']);}}</td>
                        </tr>
                        <tr>
                            <td>Library Selection</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibSelectionName($value['libselection_id']);}} </td>
                        </tr>
                        <tr>
                            <td>Library Strategy</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibStrategyName($value['libstrategy_id']);}}</td>
                        </tr>
                        <tr>
                            <td>Library Con Protocol</td>
                            <td>{{ $value['libconsprot'] }}</td>
                        </tr>
                        <tr>
                            <td>Instrument</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getInstrumentName($value['instrument_id'])}}</td>
                        </tr>
                        <tr>
                            <td>Library layout</td>
                            <td>{{ \App\Http\Controllers\DashboardBioarchiveController::getLibLayoutName($value['liblayout_id'])}}</td>
                        </tr>
                        <tr>
                            <td>Input Size</td>
                            <td>{{ $value['input_size'] }}</td>
                        </tr>
                        @if ($bioarchive->status == 4)

                        <tr>
                            <td><strong>File(s) ({{ $value['alias'] }})</strong></td>
                            <td>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modal{{ $value['alias'] }}">
                                        Web Upload
                                    </button>
                                     - or -
                                    <button type="button" class="btn btn-sm btn-outline-success ms-1" data-bs-toggle="collapse" data-bs-target="#collapse{{ $value['alias'] }}" aria-expanded="false" aria-controls="collapse{{ $value['alias'] }}" >
                                        FTP/SFTP Upload
                                    </button>
                                </div>
                                <div class="collapse" id="collapse{{ $value['alias'] }}">
                                    <div class="card card-body">
                                        Username: {{$ftp_user->username}}<br>
                                        Password: {{$ftp_user->password}}
                                    </div>
                                </div>
                                <div>
                                    <small class="text-secondary">Please use FTP/SFTP for easier uploads or for files larger than 1GB.</small>
                                </div>
                                @if (count($files) > 0)
                                <table class="m-auto table table-responsive text-nowrap">
                                    @foreach ($files as $file)
                                        @foreach ($file as $key => $items)
                                            @if ($key === $value['alias'])
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td>
                                                        {{array_reverse(explode("/",$item))[0]}}
                                                        <span>
                                                            <form action="/dashboard/file/delete" method="post" class="d-inline">
                                                                @method('post')
                                                                @csrf
                                                                <input type="hidden" name="source" value="sftp">
                                                                <input type="hidden" name="accession" value="{{$bioarchive->accession}}">
                                                                <input type="hidden" name="alias" value="{{$key}}">
                                                                <input type="hidden" name="file" value="{{$item}}">
                                                                <button class="btn btn-sm btn-danger float-end" onclick="return confirm('Are you sure ?')" ><span data-feather="x-circle" title="Delete"></span></button>
                                                            </form>
                                                            <form action="/dashboard/file/download" method="post" class="d-inline">
                                                                @method('post')
                                                                @csrf
                                                                <input type="hidden" name="file" value="{{$item}}">
                                                                <input type="hidden" name="accession" value="{{$bioarchive->accession}}">
                                                                <button class="btn btn-sm btn-info me-1 float-end" ><span data-feather="download" title="Download"></span></button>
                                                            </form>
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                                @else
                                <div class="mt-2">
                                    No files have been uploaded yet.
                                </div>
                                @endif
                            </td>
                        </tr>
                        <div class="modal fade modalfile" id="modal{{ $value['alias'] }}" tabindex="-1" aria-labelledby="modal{{ $value['alias'] }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal{{ $value['alias'] }}Label">Upload {{ $value['alias'] }} File(s) </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dashboard/file/upload"
                                        class="dropzone"
                                        id="form{{ $value['alias'] }}">
                                        <div class="row mt-3">
                                            <label for="filetype{{ $value['alias'] }}" class="col-sm-2 col-form-label col-form-label-sm form-label">File Type</label>
                                            <div class="col-sm-10">
                                                <select name="filetype" id="filetype{{ $value['alias'] }}" class="form-select" aria-label="Default select example">
                                                    @foreach ($filetypes as $filetype)
                                                        <option value="{{$filetype->id}}">{{$filetype->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                          </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>
                                </div>
                            </div>
                            </div>

                        @else
                        <tr>
                            <td><strong>File</strong></td>
                        @foreach ($files as $file)
                            @foreach ($file as $key => $items)
                                @if ($key === $value['alias'])
                                @foreach ($items as $item)
                                {{-- <tr> --}}
                                    {{-- <td></td> --}}
                                    <td>
                                       {{array_reverse(explode("/",$item))[0]}}
                                        <span>
                                            <form action="/dashboard/file/download" method="post" class="d-inline">
                                                @method('post')
                                                @csrf
                                                <input type="hidden" name="file" value="{{$item}}">
                                                <button class="btn btn-sm btn-info me-1 float-end" ><span data-feather="download" title="Download"></span></button>
                                            </form>
                                        </span>
                                    </td>
                                {{-- </tr> --}}
                                @endforeach

                                @endif
                            @endforeach
                        @endforeach

                        </tr>
                        @endif
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        @if ($bioarchive->status===4)
        <form action="/dashboard/bioarchives/{{$bioarchive->accession}}" class="row p-2" method="post" class="d-inline">
            @method('put')
            @csrf
            <input type="hidden" name="action" id="action" value="fileUploaded">
            <input type="hidden" name="target" value="{{$bioarchive->curator_id}}">
            <input type="hidden" name="bioarchive_id" id="bioarchive_id" value="{{ $bioarchive->id }}">
            <label class="fw-bolder" for="action">Action:</label>
            <div class="col-12 d-grid gap-2">
                <button type="button" id="btModalCompleteFile" class="btn btn-primary btn-block border-0" data-bs-toggle="modal" data-bs-target="#modalCompleteFile">Complete File Upload Process</button>
            </div>
            <div class="modal fade" id="modalCompleteFile" tabindex="-1" aria-labelledby="modalCompleteFileLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCompleteFileLabel">Complete File Upload Process</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="desc" class="form-label">Insert Description (Optional)</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
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
        <div class="card m-2">
            <div class="card-header">
                <h6>History</h6>
            </div>
            <div class="card-body">
                <section>
                    <ul class="timeline">

                        @if ($bioarchive->published_at !== null)
                        <li class="timeline-item mb-5">
                            <strong class="fw-bolder">Published</strong>
                            <p class="fw-lighter mb-1">{{$bioarchive->published_at->format('j F Y H:i')}}</p>
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
                            <strong class="fw-bolder">Bioarchive Created </strong>
                            <p class="fw-lighter mb-1">{{$bioarchive->created_at->format('j F Y H:i')}}</p>
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


         @foreach ($bioexperiment as $item => $value)

        var myDropzone{{$value['id']}} = new Dropzone("#form{{ $value['alias']}}", {
            chunking: true,
            method: "POST",
            maxFilesize: 21474836480, //2gb
            chunkSize: 104857600, // 100mb
            parallelChunkUploads: true,
        });

        myDropzone{{ $value['id']}}.on('sending', function (file, xhr, formData) {
            formData.append("_token", '{{ csrf_token() }}');
            formData.append("mainFolder", "{{$bioarchive->accession}}")
            formData.append("bioexperiment_id", "{{$value['id']}}")
            formData.append("subFolder", "{{ $value['alias']}}")
            formData.append("filetype", document.getElementById("filetype{{ $value['alias'] }}").value)
            console.log(formData,Object.fromEntries(formData))
        }).on("complete", function(file) {
            console.log("complete:",file);
        }).on('error', function(file, response) {
            console.error("ERROR:",response)
        });
        @endforeach

        $(".modalfile").on("hidden.bs.modal", function () {
            location.reload()
        });
    </script>
@endpush
