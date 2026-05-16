@extends('dashboard.layouts.main')
@section('title', 'Bioarchive - '. $bioarchive->accession)

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

    .modal-body .responses {
        min-width: 350px;
    }

    .modal-body .responses p {
        margin-bottom: .25rem;
        padding-left: 50px;
        white-space: pre-line
    }

    .modal-body .responses p.respond {
        font-weight: bold;
    }
    .modal-body .responses p.cmd:before {
        content: "CMD :";
        position: absolute;
        margin-left: 20px;
        left:0
    }

    .modal-body .responses p.respond:before {
        content: "RSP :";
        position: absolute;
        margin-left: 20px;
        left:0
    }

    table tr.separator { height: 15px; }
</style>
@endpush

@section('container')
@php
    $formatBp = function ($bp) {
        if ($bp === null || $bp === '') {
            return '';
        }
        if (!is_numeric($bp)) {
            return (string) $bp;
        }

        $bp = (float) $bp;
        $abs = abs($bp);

        $units = [
            ['Gbp', 1000000000],
            ['Mbp', 1000000],
            ['kbp', 1000],
            ['bp', 1],
        ];

        foreach ($units as $u) {
            [$unit, $factor] = $u;
            if ($abs >= $factor || $factor === 1) {
                $value = $bp / $factor;
                if ($factor === 1) {
                    $decimals = 0;
                } else {
                    $scaled = $abs / $factor;
                    $decimals = $scaled >= 100 ? 0 : ($scaled >= 10 ? 1 : 2);
                }

                $formatted = number_format($value, $decimals, '.', ',');
                if ($decimals > 0) {
                    $formatted = rtrim(rtrim($formatted, '0'), '.');
                }
                return $formatted . ' ' . $unit;
            }
        }

        return (string) $bp . ' bp';
    };
@endphp
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
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
                                            <td>{{ $formatBp($value['input_size']) }}</td>
                                        </tr>
                                        @if (count($files) > 0 && $bioarchive->draft == false )
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
                                                                    <td>
                                                                        @php
                                                                        $biorunmd5 = "";   
                                                                        @endphp
                                                                        @foreach ($runs as $biorun)
                                                                            @if ($biorun->md5 !== $biorunmd5)
                                                                                {{ $biorun->filename == array_reverse(explode("/",$item))[0] ? $biorun->md5 : "" }}
                                                                                @php
                                                                                $biorunmd5 = $biorun->filename == array_reverse(explode("/",$item))[0] ? $biorun->md5 : "" ;
                                                                                @endphp     
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
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
                                        @if ($bioarchive->status == 2)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#fileCheck{{$value['alias']}}">
                                                    File(s) Check
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
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
                                                        <div class="modal-body" style="min-height:400px">
                                                            <div id="textResponses{{$value['alias']}}" class="responses" style="min-height: 380px">
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 m-3">
                                                            <div class="col-10">
                                                                <input type="text" class="form-control" id="command{{$value['alias']}}" placeholder="Type your command!">
                                                            </div>
                                                            <div class="col-2">
                                                                <button id="btnSendCmd{{$value['alias']}}" class="btn btn-primary w-100">Send</button>
                                                            </div>
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
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-12 col-xl-4">
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
            <div class="card">
                <div class="card-header">
                    <h5>History</h5>
                </div>
                
                <div class="card-body">
                    <ul class="simple-timeline mb-0">
                        @if ($bioarchive->published_at !== null)
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-dot timeline-dot-success"></span>
                            <div class="timeline-time">
                                <div class="timeline-header-section mb-2">
                                    <h6 class="mb-0">Published</h6>
                                    <small class="fw-light">{{$bioarchive->published_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    This bioarchive has been published and is now publicly accessible.
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
                                    <small class="fw-light">{{$bioarchive->created_at->format('j F Y H:i')}}</small>
                                </div>
                                <p class="text-muted mb-2">
                                    Bioarchive submitted successfully.
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
            let respond = "gagal"


            function buttonLoading(element,state,text="") {
                if (state) {
                    element.innerHTML = `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>`
                    element.disabled = true
                } else {
                    element.innerHTML = text
                    element.disabled = false
                }
            }

            function fileCuration(bioexperiment_id, elem, cmd, folder, item, button) {
                let fileName = files[item][folder][0].split('/').slice(-1)[0]
                let extension = fileName.split('.').slice(-1)[0]
                elem.innerHTML +=`<p class="cmd">${cmd}</p>`
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
                            "cmd": [`cd innasto/temp/{{$bioarchive->accession}}/${folder}`,cmd],
                            '_token': '{{ csrf_token() }}'
                        }
                    )
                })
                .then(response => response.text())
                .then(response => {
                    elem.innerHTML +=`<p class="respond">${response}</p>`
                    buttonLoading(button,false,"Send")
                })
            }

            

        



            @foreach ($bioexperiment as $item => $value)
            const textResponses{{$item}} =  document.getElementById('textResponses{{$value['alias']}}')
            const btnSendCmd{{$item}} = document.getElementById('btnSendCmd{{$value['alias']}}')
            const command{{$item}} = document.getElementById('command{{$value['alias']}}')


            btnSendCmd{{$item}}.addEventListener("click", function() {
                if (command{{$item}}.value.trim().length == 0) {
                    alert("Input Command");
                    return false
                }
                fileCuration({{$value['id']}},textResponses{{$item}}, command{{$item}}.value, '{{$value['alias']}}', '{{$item}}', btnSendCmd{{$item}})
                command{{$item}}.value = ""
                buttonLoading(btnSendCmd{{$item}},true,"")

            })

            command{{$item}}.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    btnSendCmd{{$item}}.click();
                }
            });

            
            const modalFileCheck{{$item}} = document.getElementById('fileCheck{{$value['alias']}}')
            if (modalFileCheck{{$item}}  !== null) {
                modalFileCheck{{$item}}.addEventListener('shown.bs.modal', function () {
                    buttonLoading(btnSendCmd{{$item}},true,"")
                    fileCuration({{$value['id']}},textResponses{{$item}}, "ls ", '{{$value['alias']}}', '{{$item}}', btnSendCmd{{$item}})
                })
            }

            @endforeach

        })
    </script>
@endpush
