@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Input Biosample Data</h1>
</div>
<div class="col-lg-10">

    <form method="post" action="/dashboard/biosamples">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="umbrella" class="form-label">Umbrella Project</label>
            <select class="form-select" name="umbproject_id" id="umbproject_id">
                <option value="">Umbrella Project</option>
                @foreach ($umbrellas as $umbrella )
                <option value="{{$umbrella->id}}" @if (old('umbproject_id')==$umbrella->id) selected @endif>{{$umbrella->title}}</option>
                @endforeach
            </select>

            @error('umbproject_id')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="organism" class="form-label">Organism</label>
            <select class="form-select" name="organism_id" id="organism_id">
                <option value="">Organism</option>
                @foreach ($organisms as $organism )
                <option value="{{$organism->id}}" @if (old('organism_id')==$organism->id) selected @endif>{{$organism->name}}</option>
                @endforeach
            </select>

            @error('organism_id')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="relevance" class="form-label">Relevance</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="relevance" name="relevance" value="{{old('relevance')}}">
            @error('relevance')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>

            @error('description')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="mb-3">Data Type</label>
            @foreach ($datatypes->chunk(6) as $row)
            <div class="row">
                @foreach ( $row as $datatype)
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="data_type_id[]" value="{{$datatype->id}}" @if(is_array(old('data_type_id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
                        <label class="form-check-label">{{$datatype->name}}</label>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach

            @error('data_type_id')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="mb-3">Sample Scope</label>
            @foreach ($samplescopes->chunk(6) as $row)
            <div class="row">
                @foreach ( $row as $samplescope)
                <div class="col-sm-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="samplescope_id" value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id)) checked @endif>
                        <label class="form-check-label">{{$samplescope->name}}</label>
                    </div>
                </div>

                @endforeach
            </div>
            @endforeach

            @error('samplescope_id')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <div class="card card-outline card-info collapsed-card mb-3">
            <div class="card-header">
                <h6 class="card-title">Grants</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body mb-3">
                <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
                    <thead>
                        <tr>
                            <th scope="col">Agency</th>
                            <th scope="col">Program</th>
                            <th scope="col">Grant Title</th>
                            <th scope="col">
                                <button class="btn btn-primary" id="add_row" type="button" class="add">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="fundagency">
                        <tr>
                            <td>
                                <!-- <input type="text" name="grant_agency[]" class="form-control"> -->
                                <select class="form-select" name="fundagency_id[0]" id="grant_agency">
                                    <option value="">Funding Agency</option>
                                    @foreach ($fundagencies as $fundagency )
                                    <option value="{{$fundagency->id}}" @if (old('fundagency_id[0]')==$fundagency->id) selected @endif>{{$fundagency->name}}</option>
                                    @endforeach
                                </select>
                                @error('fundagency_id.*')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="grant_program[0]" class="form-control">
                                @error('grant_program.*')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="grant_title[0]" class="form-control">
                                @error('grant_title.*')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <button class="btn btn-danger delete_row">remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <button type="submit" class="btn btn-primary">Create Bioproject</button>
    </form>
</div>
@endsection
@push('js')
<script>
    $('#organism_id').select2({
        placeholder: "Organism",
        theme: "bootstrap-5",
        width: '100%'

    });
    $('#umbproject_id').select2({
        placeholder: "Umbrella Project",
        theme: "bootstrap-5",
        width: '100%'

    });
    $('#grant_agency').select2({
        placeholder: "Fund Agency",
        theme: "bootstrap-5",
        width: '100%'

    });
</script>
<script>
    var counterFundAgency = 0;
    var i = 0;
    $(document).ready(function() {
        $('#add_row').click(function() {
            //Add row
            counterFundAgency++;
            ++i;
            row = '';
            row += '<tr><td>';
            row += '<select id="id_fundagency' + i + '" name ="fundagency_id[' + i + ']" class="form-control">';
            rowsel = getFundAgency();
            row += rowsel
            row += '</select></td><td><input type="text" name ="grant_program[' + i + ']" class="form-control" ></td></td><td><input type="text" name ="grant_title[' + i + ']" class="form-control" ></td>';
            row += '<td><button class="btn btn-danger delete_row">remove</button></td></tr>';
            $("#fundagency").append(row);
            $('#id_fundagency' + counterFundAgency).select2({
                placeholder: "Fund Agency",
                theme: "bootstrap-5",
                width: '100%'
            });
        });

        $("#add_table").on('click', '.delete_row', function() {
            $(this).closest('tr').remove();
            counterFundAgency--;
        });

        function getFundAgency() {
            var result = "";
            $.ajax({
                url: "/dashboard/bioprojects/fetchfundingagency",
                // type: "GET",
                async: false,
                success: function(response) {
                    console.log(response)
                    rowsel = '<option value="">Select Funding Agency</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                        return rowsel;
                    });
                }
            });
            return rowsel;
        }
    });
</script>

@endpush