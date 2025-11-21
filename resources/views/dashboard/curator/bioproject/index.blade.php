@extends('dashboard.layouts.main')


@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Curator Bioprojects</li>
    </ol>
</div>
<div class="table-responsive col-md-12">
    <table class="table table-striped table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Accession</th>
                <th scope="col">Organism</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Center</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $bioprojects as $bioproject )
            <tr>
                <td></td>
                <td>{{ $bioproject->accession }}</td>
                <td>{{ $bioproject->organism->name }}</td>
                <td>{{ $bioproject->title }}</td>
                <td>{!! Str::words($bioproject->description, 20, "<a href='/dashboard/curator/bioprojects/{$bioproject->accession}'> read more...</a>") !!}</td>
                <td>{{ $bioproject->center->name ?? "" : $bioproject->center->name}}</td>
                {{-- <td>{{ $bioproject->center_id }}</td> --}}
                <td>
                    @switch($bioproject->status)
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
                            <span class="badge bg-warning">Waiting for File upload</span>
                            @break
                        @case(5)
                            <span class="badge bg-success">Published</span>
                            @break
                        @default
                            <span class="badge bg-secondary">Rejected</span>
                    @endswitch
                </td>
                <td style="min-width: 80px">
                    <a href="/dashboard/curator/bioprojects/{{ $bioproject->accession}}" class="badge bg-info"><span data-feather="eye"></span></a>
                    @if ($bioproject->status == 5)
                    <div id="tdDv{{$bioproject->accession}}" style="display: inline">
                    @if($bioproject->dv_published_at)
                    <a type="button" href="{{config('services.api_dataverse.base_url_dataverse') }}/dataverse/{{$bioproject->accession}}" target="_blank" title="View in dataverse" class="badge btn-dataverse"><img alt="dv-logo" src="/images/dv-icon.png" height="15px"></img></a>
                    @else
                    <button onclick="javscript:dataverseSync('{{ $bioproject->accession}}')" type="button" title="Sync to dataverse" class="badge btn-dataverse-outline"><img alt="dv-logo" src="/images/dv-icon.png" height="15px"></img></button>
                    @endif
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


@push('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        window.APP_CONFIG = {
            dataverseBaseUrl: "{{ config('services.api_dataverse.base_url_dataverse') }}"
        };
        let accession = null
        const baseurl = window.APP_CONFIG.dataverseBaseUrl;
        bsConfirmModalButton.addEventListener("click",()=>{
            bsConfirmModalButton.disabled = true
            bsConfirmModalTitle.textContent = `Syncing with dataverse...`
            bsConfirmModalSpinner.classList.remove("d-none")
            bsConfirmModalText.textContent = `Please do not close this window until syncing process has finished.`
            fetch("{{route('createDataverse')}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
                    document.querySelector(`#tdDv${accession}`).innerHTML = `<a type="button" href="${baseurl}/dataverse/${accession}" target="_blank" class="btn btn-sm btn-dataverse-outline">View <img alt="dv-logo" src="/images/dv-icon.png" height="16px"></img></a>`
                } else {
                    showToast(`Error: ${JSON.stringify(data)}`, "danger")
                    bsConfirmModalTitle.textContent = `Something went wrong`
                    bsConfirmModalSpinner.classList.add("d-none")
                    bsConfirmModalText.textContent = `Error: ${error}`
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
            bsConfirmModalTitle.textContent = `Sync ${accession} bioproject to dataverse?`
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

@endpush
