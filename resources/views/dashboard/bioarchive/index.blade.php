@extends('dashboard.layouts.main')
@section('title', 'My Bioarchives')

@push('css')
<link href="/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush


@section('container')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                @if(empty($hasDraft))
                <a href="/dashboard/bioarchives/create" class="btn btn-primary">Create New Bioarchive</a>
                @else
                <div class="alert alert-info alert-dismissible fade show col-lg-12" role="alert">
                    <strong>
                        You have bioarchive submission draft. 
                        <a href="/dashboard/bioarchives/create" class="alert-link">Click here to complete or discard your draft before creating a new one.</a> 
                    </strong>
                </div>
                <button type="button" class="btn btn-primary" style="cursor: pointer" disabled>
                    Create New Bioarchive
                </button>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Accession</th>
                                <th scope="col">Submission ID</th>
                                <th scope="col">Bioproject</th>
                                <th scope="col">Biosample</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $bioarchives as $bioarchive )
                            <tr>
                                <td class="text-center"></td>
                                <td>{{ $bioarchive->accession }}</td>
                                <td>{{ $bioarchive->submission_id }}</td>
                                <td>{{ $bioarchive->bioproject->accession }}</td>
                                <td>
                                    @foreach (explode(',', $bioarchive->biosample_id) as $biosample )
                                        <table>
                                            @php
                                                $samples = DB::table('biosamples')->where('id', $biosample)->get();
                                            @endphp
                                            <tr>
                                                @foreach ($samples as $smp)
                                                <td>{{ $smp->accession }}</td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">
                                    @if($bioarchive->status == 5 && $bioarchive->hold_release)
                                        <span class="badge bg-primary">On Hold</span>
                                    @else
                                        @switch($bioarchive->status)
                                            @case(1)
                                                <span class="badge bg-danger">Unassigned</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-info">On review</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-warning">Returned to submitter</span>
                                                @break
                                            @case(4)
                                                <span class="button badge bg-warning">Waiting for File upload</span>
                                                @break
                                            @case(5)
                                                <span class="badge bg-success">Published</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Rejected</span>
                                        @endswitch
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="white-space: nowrap">
                                    @if (!$bioarchive->draft)
                                        <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                                    @else
                                        @if ($bioarchive->status==4)
                                            <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="upload"></span></a>
                                        @else
                                            <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                                            <a href="/dashboard/bioarchives/{{ $bioarchive->accession}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                                            <form action="/dashboard/bioarchives/{{$bioarchive->accession}}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')"><span data-feather="x-circle"></span></button>
                                            </form>
                                        @endif
                                    @endif
                                    @if ($bioarchive->status == 5)
                                        @if ($bioarchive->hold_release)
                                            <button type="button" class="badge bg-primary" onclick="openReleaseModal('{{ $bioarchive->accession }}')" title="Release"><span data-feather="unlock"></span></button>
                                        @else
                                            <div id="tdDv{{$bioarchive->accession}}" style="display: inline">
                                                @if($bioarchive->dv_persistent_id)
                                                    <a type="button" href="{{config('services.api_dataverse.base_url_dataverse') }}/dataset.xhtml?persistentId={{$bioarchive->dv_persistent_id}}" target="_blank" title="View in dataverse" class="badge btn-dataverse"><img alt="dv-logo" src="/images/dv-icon.png" height="15px"></img></a>
                                                @else
                                                    <button onclick="dataverseSync('{{ $bioarchive->accession}}')" type="button" title="Sync to dataverse" class="badge btn-dataverse-outline"><img alt="dv-logo" src="/images/dv-icon.png" height="15px"></img></button>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@push('js')
    <!-- Datatables js -->
    <script src="/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- dataTables.bootstrap5 -->
    <script src="/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- buttons.colVis -->
    <script src="/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <script src="/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

    <!-- dataTable.responsive -->
    <script src="/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- dataTables.select -->
    <script src="/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>
    <script>
        let accession = null
        window.APP_CONFIG = {
            dataverseBaseUrl: "{{ config('services.api_dataverse.base_url_dataverse') }}"
        };
        const baseurl = window.APP_CONFIG.dataverseBaseUrl;
        

        bsConfirmModalButton.addEventListener("click",()=>{
            apiKey = document.getElementById('apiKeyInput').value;
            if(!apiKey) {
                showToast("API-Key tidak boleh kosong!", "danger");
                // console.log("testing api key");
                return;
            }
            bsConfirmModalButton.disabled = true
            bsConfirmModalTitle.textContent = `Syncing with dataverse...`
            bsConfirmModalSpinner.classList.remove("d-none")
            bsConfirmModalText.textContent = `Please do not close this window until syncing process has finished.`
            fetch("{{route('createDatasetArchive')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "X-DATAVERSE-KEY": apiKey // Kirim API-key di header
                },
                body: JSON.stringify({'accession':accession})
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
                if (data.status === "OK") {
                    bsConfirmModalSpinner.classList.add("d-none")
                    bsConfirmModal.hide()
                    showToast("Synced with dataverse")
                    document.querySelector(`#tdDv${accession}`).innerHTML = `<a type="button" href="${baseurl}/dataset.xhtml?persistentId=${data.data.persistentId}" target="_blank" class="badge btn-dataverse-outline">View <img alt="dv-logo" src="/images/dv-icon.png" height="15px"></img></a>`
                } else {
                    showToast(`${data.status} - ${data.message}`, "danger")
                    console.log(data)
                    bsConfirmModalTitle.textContent = `Something went wrong`
                    bsConfirmModalSpinner.classList.add("d-none")
                    bsConfirmModalText.textContent = `${data.status} - ${data.message}`
                }
            })
            .catch((error) => {
                console.error("Error:", error)
                bsConfirmModalTitle.textContent = `Something went wrong`
                bsConfirmModalSpinner.classList.add("d-none")
                bsConfirmModalText.textContent = `Error: ${error}`
            });
            bsConfirmModalButton.disabled = false
        })
        function dataverseSync(id) {
            accession = id
            bsConfirmModalTitle.textContent = `Sync ${accession} bioarchive to dataverse?`
            bsConfirmModalText.textContent = `Silakan masukkan API-Key Dataverse Anda sebelum melanjutkan.`;
            bsConfirmModalSpinner.classList.add("d-none");
            bsConfirmModalButton.disabled = false;
            // Cek apakah input sudah ada, jika belum tambahkan
            if (!document.getElementById('apiKeyInput')) {
                const inputDiv = document.createElement('div');
                inputDiv.className = 'mb-3 mt-3';
                const input = document.createElement('input');
                input.type = 'password';
                input.id = 'apiKeyInput';
                input.className = 'form-control';
                input.placeholder = 'Masukkan API-Key Dataverse';
                input.autocomplete = 'off';
                inputDiv.appendChild(input);

                // Sisipkan input sebelum spinner (atau di akhir modal body jika tidak ada spinner)
                const modalBody = bsConfirmModalText.parentElement;
                if (document.getElementById('bsConfirmModalSpinner')) {
                    modalBody.insertBefore(inputDiv, document.getElementById('bsConfirmModalSpinner'));
                } else {
                    modalBody.appendChild(inputDiv);
                }
            } else {
                // Reset jika sudah ada
                document.getElementById('apiKeyInput').value = '';
            }
            bsConfirmModal.show()
        }
        $(document).ready(function () {
            const dataTable = $('#dataTable').DataTable({
                    columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: 0,
                    },
                ],
                order: [[1, 'asc']],
            });
            dataTable.on('order.dt search.dt', function () {
                let i = 1;

                dataTable.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                    this.data(i++);
                });
            }).draw();
        });

    </script>

        <script>
                // Release modal logic for bioarchives
                let releaseAccession = null;
                function openReleaseModal(accession) {
                        releaseAccession = accession;
                        if (!document.getElementById('releaseConfirmModal')) {
                                const modalHtml = `
                                <div class="modal fade" id="releaseConfirmModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Release</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p id="releaseModalText"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" id="confirmReleaseButton" class="btn btn-primary">Yes, Release</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                document.body.insertAdjacentHTML('beforeend', modalHtml);
                        }
                        document.getElementById('releaseModalText').textContent = `Are you sure want to release ${accession}?`;
                        const modal = new bootstrap.Modal(document.getElementById('releaseConfirmModal'));
                        modal.show();
                        const btn = document.getElementById('confirmReleaseButton');
                        btn.onclick = function () {
                                btn.disabled = true;
                                fetch(`/dashboard/bioarchives/${releaseAccession}/release`, {
                                        method: 'POST',
                                        headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({})
                                })
                                .then(res => res.json())
                                .then(data => {
                                        if (data.status && data.status === 'OK') {
                                                location.reload();
                                        } else {
                                                alert('Failed to release');
                                                btn.disabled = false;
                                        }
                                })
                                .catch(() => {
                                        alert('Failed to release');
                                        btn.disabled = false;
                                });
                        };
                }
        </script>

@endpush
