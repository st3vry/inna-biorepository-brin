@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Galaxy Workflows</h1>
    </div>

    <div class="col-lg-12" id="app">
        {{-- <workflows-grid></workflows-grid> --}}
        {{-- test --}}
        @if (Session::has('statusJob'))
            <div class="alert alert-primary" role="alert">
                {{ Session::get('statusJob') }}
            </div>
        @endif
        <form method="POST" action="{{ route('send.workflow') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Galaxy Workflows</label>
                <select id="workflow" class="form-select" name="workflow" aria-label="Default select example">
                    <option selected>Choose workflows</option>
                    @foreach ($workflows as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="archive" class="form-label">Choose Bioarchive</label>
                <select id="archive" class="form-select" name="archive" aria-label="Archive">
                    <option selected>Choose Archive</option>
                    @foreach ($archive as $item)
                        <option value="{{ $item->id }}">{{ $item->accession }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="experiment" class="form-label">Choose Bioexperiment</label>
                <select id="experiment" class="form-select" name="experiment" aria-label="Experiment">
                    <option selected>Choose Experiment</option>
                </select>
            </div>

            <!-- Container untuk dynamic input runs -->
            <div id="dynamic-runs-container">
                <!-- Input runs akan ditambahkan di sini secara dinamis -->
            </div>

            {{-- <div class="mb-3">
        <label for="run" class="form-label">Choose Biorun</label>
        <select id="run" class="form-select" name="run" aria-label="run">
            <option selected>Choose Filename</option>
        </select>
    </div> --}}


            {{-- <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Input 1</label>
        <input type="input1" name="input1" class="form-control" value="A1_1.fq.gz" id="exampleFormControlInput1" placeholder="File 1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Input 2</label>
        <input type="input2" name="input2" class="form-control" value="A1_2.fq.gz" id="exampleFormControlInput2" placeholder="File 2">
    </div> --}}

            {{-- <button type="submit" class="btn btn-primary">Proceed</button> --}}
            <!-- Submit button - initially hidden -->
            <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none;">Submit Job</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        const archive = $("#archive")
        const experiment = $("#experiment")
        const run = $("#run")
        const workflow = $("#workflow")
        const dynamicRunsContainer = $("#dynamic-runs-container")
        const submitBtn = $("#submitBtn")

        // Handle workflow change untuk generate dynamic inputs
        workflow.on("change", function(e) {
            const selectedOption = $(this).find('option:selected');
            const inputs = selectedOption.data('inputs');

            // Clear previous dynamic inputs
            dynamicRunsContainer.empty();
            submitBtn.hide();

            if (inputs && Object.keys(inputs).length > 0) {
                generateDynamicInputs(inputs);
                checkFormCompletion();
            }
        });

        archive.on("change", function(e) {
            // experiment.empty()
            // experiment.append(getExperiment(archive.val()))
            experiment.empty()
            experiment.append('<option selected value="">Choose Experiment</option>')

            if ($(this).val()) {
                experiment.append(getExperiment(archive.val()))
            }

            // Clear runs ketika archive berubah
            dynamicRunsContainer.find('.run-select').each(function() {
                $(this).empty().append('<option selected value="">Choose Run</option>');
            });

            checkFormCompletion();
        })
        experiment.on("change", function(e) {
            // run.empty()
            // run.append(getRun(experiment.val()))
            // Update semua run selects
            if ($(this).val()) {
                dynamicRunsContainer.find('.run-select').each(function() {
                    $(this).empty()
                    $(this).append('<option selected value="">Choose Run</option>')
                    $(this).append(getRun(experiment.val()))
                });
            } else {
                dynamicRunsContainer.find('.run-select').each(function() {
                    $(this).empty().append('<option selected value="">Choose Run</option>');
                });
            }

            checkFormCompletion();
        })

        // Handle run select changes
        $(document).on('change', '.run-select', function() {
            checkFormCompletion();
        });

        function generateDynamicInputs(inputs) {
            Object.keys(inputs).forEach(function(key) {
                const input = inputs[key];
                const inputHtml = `
                <div class="mb-3">
                    <label for="run_${key}" class="form-label">${input.label}</label>
                    <select id="run_${key}" class="form-select run-select" name="run_${key}" aria-label="run_${key}" required>
                        <option selected value="">Choose Run</option>
                    </select>
                    <input type="hidden" name="input_uuid_${key}" value="${input.uuid}">
                </div>
            `;
                dynamicRunsContainer.append(inputHtml);
            });

            // Jika experiment sudah dipilih, populate runs
            if (experiment.val() && experiment.val() !== "") {
                dynamicRunsContainer.find('.run-select').each(function() {
                    $(this).empty()
                    $(this).append('<option selected value="">Choose Run</option>')
                    $(this).append(getRun(experiment.val()))
                });
            }
        }

        function checkFormCompletion() {
            let isComplete = true;

            // Check if workflow is selected
            if (!workflow.val() || workflow.val() === "") {
                isComplete = false;
            }

            // Check if archive is selected
            if (!archive.val() || archive.val() === "") {
                isComplete = false;
            }

            // Check if experiment is selected
            if (!experiment.val() || experiment.val() === "") {
                isComplete = false;
            }

            // Check if all run selects have values
            dynamicRunsContainer.find('.run-select').each(function() {
                if (!$(this).val() || $(this).val() === "") {
                    isComplete = false;
                }
            });

            // Show/hide submit button
            if (isComplete && dynamicRunsContainer.find('.run-select').length > 0) {
                submitBtn.show();
            } else {
                submitBtn.hide();
            }
        }

        function getArchive(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getArchive/" + id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Archive</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['accession'] +
                            '</option>';
                        return rowsel;
                    });
                },
                error: function(data) {
                    console.log(data.status + ':' + data.statusText, data.responseText);
                }
            });
            return rowsel;
        }

        function getExperiment(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getExperiment/" + id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Experiment</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['alias'] + ' - ' +
                            value['title'] + ' - ' + value['biosample']['title'] + '</option>';
                        return rowsel;
                    });
                },
                error: function(data) {
                    console.log(data.status + ':' + data.statusText, data.responseText);
                }
            });
            return rowsel;
        }

        function getRun(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getRun/" + id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Run</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['alias'] + ' - ' +
                            value['filename'] + '</option>';
                        return rowsel;
                    });
                },
                error: function(data) {
                    console.log(data.status + ':' + data.statusText, data.responseText);
                    alert('Error loading runs. Please try again.');
                }
            });
            return rowsel;
        }
    </script>
@endpush
