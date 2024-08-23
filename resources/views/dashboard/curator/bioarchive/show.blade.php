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

    table tr.separator { height: 15px; }
</style>
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <!-- <h1 class="h2"> Accession : {{$bioarchive->alias}}</h1> -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dashboard/curator/bioarchives">Curator Bioarchives</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$bioarchive->accession}}</li>
    </ol>
</div>
@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('success')}}</strong>
</div>
@endif

@if (session()->has('error'))

<div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
    <strong> {{session('error')}}</strong>
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
                            <td><strong>{{\App\Models\Biosample::select('accession')->where('id', $value['biosample_id'] )->pluck('accession')->first(); }}</strong></td>
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
                            <td>{{\App\Models\LibrarySource::select('name')->where('id', $value['libsource_id'])->pluck('name')->first();  }}</td>
                        </tr>
                        <tr>
                            <td>Library Selection</td>
                            <td>{{\App\Models\LibrarySelection::select('name')->where('id',  $value['libselection_id'])->pluck('name')->first(); }}</td>
                        </tr>
                        <tr>
                            <td>Library Strategy</td>
                            <td>{{ \App\Models\LibraryStrategy::select('name')->where('id',  $value['libstrategy_id'])->pluck('name')->first(); }}</td>
                        </tr>
                        <tr>
                            <td>Library Con Protocol</td>
                            <td>{{ $value['libconsprot'] }}</td>
                        </tr>
                        <tr>
                            <td>Instrument</td>
                            <td>{{ \App\Models\Instrument::select('name')->where('id',  $value['instrument_id'])->pluck('name')->first(); }}</td>
                        </tr>
                        <tr>
                            <td>Library layout</td>
                            <td>{{ \App\Models\LibraryLayout::select('name')->where('id', $value['liblayout_id'])->pluck('name')->first(); }}</td>
                        </tr>
                        <tr>
                            <td>Input Size</td>
                            <td>{{ $value['input_size'] }}</td>
                        </tr>
                        @if (count($files) > 0 && $bioarchive->status == 2 && $bioarchive->draft == false )
                        <tr>
                            @php
                                $runs =  App\Models\Biorun::Select('*')->where('bioexperiment_id',$value['id'])->get()
                            @endphp
                            <td class="col-sm-2"><strong>BioRun</strong></td>
                            <td>
                                <table class="m-auto table table-striped table-hover table-responsive text-nowrap" >
                                    @foreach ($files as $file)
                                        @foreach ($file as $key => $items)
                                            @if ($key === $value['alias'])
                                                <tr>
                                                    <th>Alias</th>
                                                    <td>{{ $key }}</td>
                                                </tr>
                                                @foreach ($items as $item)
                                                <tr>
                                                    <td>File Name</td>
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
                                                <tr>
                                                    <td>MD5 Checksum</td>
                                                    <td>{{ $runs[0]->md5 ?? "" }}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                            {{-- @foreach ($files as $i =>$file)
                                @foreach ($file as $key => $item)
                                    @if ($key === $value['alias'])
                                    @foreach ($item as $it)
                                    <tr>
                                        <td>File {{$key}} ({{ $i+1}})</td>
                                        <td>
                                            {{$it}}
                                        </td>
                                    </tr>
                                    @endforeach

                                    @endif
                                @endforeach
                            @endforeach --}}
                        <tr>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#fileCheck{{$value['alias']}}">
                                    File Check
                                </button>
                            </td>
                        </tr>
                        @endif
                        <tr class="separator">
                        </tr>
                            <div class="modal fade" id="fileCheck{{$value['alias']}}" tabindex="-1" aria-labelledby="fileCheck{{$value['alias']}}Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileCheck{{$value['alias']}}Label">{{$value['alias']}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="min-height:300px">

                                            <form action="{{route('updateBiorun')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="alias" value="{{$value['alias']}}">
                                                <input type="hidden" name="bioexperiment_id" value="{{$value['id']}}">
                                                <input type="hidden" name="filetype" value="1">
                                                <div class="mb-1 row">
                                                    <label for="fileNameInModal{{$value['id']}}" class="col-sm-2 col-form-label">File Name</label>
                                                    <div class="col-sm-10">
                                                    <input type="text" readonly class="form-control-plaintext" name="fileNameInModal" id="fileNameInModal{{$value['id']}}" value="-">
                                                    </div>
                                                </div>
                                                <div class="mb-2 row">
                                                    <label for="md5InModal{{$value['id']}}" class="col-sm-2 col-form-label">Response:</label>
                                                    <div class="col-sm-10">
                                                    <input type="text" readonly class="form-control-plaintext" name="md5InModal" id="md5InModal{{$value['id']}}" value="-">
                                                    </div>
                                                </div>
                                            <div id="sshRespon{{$value['alias']}}"></div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="btmd5{{$value['alias']}}">MD5 Checksum</button>

                                            <button disabled id="btSubmitBiorun{{$value['id']}}" type="submit" class="btn btn-primary">Save Change</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </table>
                </td>
            </tr>

        </table>
    </div>
    <div class="col-md-4">
        @canany(['isSuperAdmin','isAdmin'])
            {{-- @if ($bioarchive->status === 1) --}}
                <form action="/dashboard/curator/bioarchives/{{$bioarchive->accession}}" class="row p-2" method="post" class="d-inline">
                    @method('put')
                    @csrf
                    <input type="hidden" name="action" value="assignedToCurator">
                    <label class="fw-bolder" for="target">{{$bioarchive->curator_id === null ? 'Assign' : 'Assigned' }} to:</label>
                    <div class="col-8">
                        <select class="form-select" name="target" id="target">
                            <option value="" disabled selected >Select curator</option>
                            @foreach ($curators as $curator)
                            <option value="{{$curator->id}}" {{$bioarchive->curator_id == $curator->id ? 'selected' : ''}}>{{$curator->name}}</option>
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

            {{-- @endif --}}
        @endcanany
        @can('isCurator')
        @if ($bioarchive->status===2)
        <form action="/dashboard/curator/bioarchives/{{$bioarchive->accession}}" class="row p-2" method="post" class="d-inline">
            @method('put')
            @csrf
            <input type="hidden" name="target" value="{{$bioarchive->user_id}}">
            <input type="hidden" name="bioarchive_id" id="bioarchive_id" value="{{ $bioarchive->id }}">
            <input type="hidden" name="md5Input" id="md5Input" value="">
            <label class="fw-bolder" for="action">Action:</label>
            <div class="col-8">
                <select class="form-select" name="action" id="action">
                    <option value="proceedToFileUpload">Proceed to File Upload</option>
                    <option value="returnedToSubmitter">Return to submitter</option>
                    <option value="approved">Approve</option>
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
                if ('{{!$bioarchive->draft && $bioarchive->published_at === null}}') {
                    const modalActionCurator= document.getElementById('modalActionCurator')
                    const descCurator = document.getElementById('descCurator')
                    const action = document.getElementById('action')
                    const modalActionCuratorLabel = document.getElementById('modalActionCuratorLabel')
                    modalActionCurator.addEventListener('show.bs.modal', function () {
                        modalActionCuratorLabel.innerHTML = action.options[action.selectedIndex].text + " ({{$bioarchive->accession}})?"
                    })
                    modalActionCurator.addEventListener('shown.bs.modal', function () {
                        descCurator.focus()
                    })
                }

            }
            const files = @json($files, JSON_PRETTY_PRINT);
            const md5Input = document.getElementById("md5Input");
            let md5 = "gagal"
            const md5Array = []
            console.log(files[0])
            function fileCuration(bioexperiment_id, elem, fileNameInModal, md5InModal, cmd, folder, item, button) {
                let fileName = files[item][folder][0].split('/').slice(-1)[0]
                let extension = fileName.split('.').slice(-1)[0]
                console.log(fileName, extension)
                fetch('{{route('fileCuration')}}', {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(
                        {
                            "id": '{{$bioarchive->accession}}',
                            "bioexperiment_id":bioexperiment_id,
                            "folder": folder,
                            "fileName":fileName,
                            "extension":extension,
                            "filetype":1,
                            "cmd": cmd,
                            '_token': '{{ csrf_token() }}'
                        }
                    )
                })
                .then(response => response.text())
                .then(response => {
                    console.log(response)
                    md5 = response.split("  ")[0]
                    md5Array.push(md5)
                    md5Input.value = JSON.stringify(md5Array)
                    fileNameInModal.value = fileName
                    md5InModal.value = md5
                    if (md5.length > 1) {
                        button.disabled=false;
                    }
                    // elem.innerHTML += "<p> MD5 Check ("+md5+")</p>"
                })
            }



            @foreach ($bioexperiment as $item => $value)
            const btls{{$item}} = document.getElementById('btls{{$value['alias']}}')
            const btlsltr{{$item}} = document.getElementById('btlsltr{{$value['alias']}}')
            const sshRespon{{$item}} =  document.getElementById('sshRespon{{$value['alias']}}')
            const btmd5{{$item}} = document.getElementById('btmd5{{$value['alias']}}')
            const fileNameInModal{{$item}} = document.getElementById('fileNameInModal{{$value['id']}}')
            const md5InModal{{$item}} = document.getElementById('md5InModal{{$value['id']}}')
            const btSubmitBiorun{{$item}} = document.getElementById('btSubmitBiorun{{$value['id']}}')

            btmd5{{$item}}.addEventListener("click", function() {
                fileCuration({{$value['id']}},sshRespon{{$item}}, fileNameInModal{{$item}}, md5InModal{{$item}},  "md5sum ", '{{$value['alias']}}', '{{$item}}', btSubmitBiorun{{$item}})
            })

            @endforeach

        })
    </script>
@endpush
