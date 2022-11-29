@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Input Biosample Data</h1>
</div>
<div class="col-lg-10">
    @livewire('create-bioproject')

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