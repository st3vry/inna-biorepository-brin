@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Galaxy Workflows</h1>
</div>

<div class="col-lg-12" id="app">
{{-- {{ dd($workflows) }} --}}
{{-- <workflows-grid></workflows-grid> --}}
{{-- test --}}
    @if(Session::has('statusJob'))
        <div class="alert alert-primary" role="alert">
            {{ Session::get('statusJob') }}
        </div>
    @endif
 <form method="POST" action="{{ route('send.workflow') }}">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Galaxy Workflows</label>
        <select class="form-select" name="workflow" aria-label="Default select example">
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
    <div class="mb-3">
        <label for="run" class="form-label">Choose Biorun</label>
        <select id="run" class="form-select" name="run" aria-label="run">
            <option selected>Choose Filename</option>
        </select>
    </div>


    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Input 1</label>
        <input type="input1" name="input1" class="form-control" value="A1_1.fq.gz" id="exampleFormControlInput1" placeholder="File 1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Input 2</label>
        <input type="input2" name="input2" class="form-control" value="A1_2.fq.gz" id="exampleFormControlInput2" placeholder="File 2">
    </div>
    
    <button type="submit" class="btn btn-primary">Proceed</button>
</form> 
</div>
@endsection
@push('js')
<script>
    const archive = $("#archive")
    const experiment = $("#experiment")
    const run = $("#run")

    archive.on("change",function(e) {
            experiment.empty()
            experiment.append(getExperiment(archive.val()))
    })
    experiment.on("change",function(e) {
            run.empty()
            run.append(getRun(experiment.val()))
    })

    function getArchive(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getArchive/"+id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Archive</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['accession'] + '</option>';
                        return rowsel;
                    });
                },
                error: function (data) {
                    console.log(data.status + ':' + data.statusText,data.responseText);
                }
            });
            return rowsel;
    }

    function getExperiment(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getExperiment/"+id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Experiment</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['alias'] +' - '+ value['title'] + ' - '+ value['biosample']['title'] +'</option>';
                        return rowsel;
                    });
                },
                error: function (data) {
                    console.log(data.status + ':' + data.statusText,data.responseText);
                }
            });
            return rowsel;
    }
    function getRun(id) {
            $.ajax({
                url: "/dashboard/innalysis_galaxy/getRun/"+id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose Run</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['alias'] +' - '+ value['filename'] + '</option>';
                        return rowsel;
                    });
                },
                error: function (data) {
                    console.log(data.status + ':' + data.statusText,data.responseText);
                }
            });
            return rowsel;
    }
    

</script>
@endpush