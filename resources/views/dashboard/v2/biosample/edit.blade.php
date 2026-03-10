@extends('dashboard.layouts.main')
@section('title', 'Edit Biosample ' . $biosample->accession)
@section('container')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" action="{{ url('/dashboard/v2/biosamples/'.$biosample->accession) }}" method="POST" novalidate id="formBioSample">
                        {{-- <form class="needs-validation" action="http://127.0.0.1:8000/dashboard/v2/biosamples/INNAS000309" method="POST" novalidate id="formBioSample"> --}}
                        @method('put')
                        @csrf
                        <ul class="nav nav-tabs nav-fill mb-3" id="mytabs" role="tablist">
                            <li class="nav-item " role="presentation">
                                <a class="nav-link disabled active" id="tabGeneralInformation" data-bs-toggle="tab"
                                    href="#contentGeneralInfo"
                                    role="tab"
                                    aria-controls="contentGeneralInfo"
                                    aria-selected="true">
                                    General Infrormation
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link disabled"
                                    aria-disabled="true"
                                    id="tabSampleInformation"
                                    data-bs-toggle="tab"
                                    href="#contentSampleInformation"
                                    role="tab"
                                    aria-controls="contentSampleInformation"
                                    aria-selected="false">
                                    Sample Information
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link disabled"
                                    id="tabPreview"
                                    data-bs-toggle="tab"
                                    href="#contentPreview"
                                    role="tab"
                                    aria-controls="contentPreview"
                                    aria-selected="false">
                                    Preview
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="contentGeneralInfo" role="tabpanel" aria-labelledby="contentGeneralInfo">
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Description
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" id="sample_description" name="sample_description" placeholder="Biosample description" rows="3">{{ old('sample_description', $biosample->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Release <span class="text-danger">*</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hold_release" id="exampleRadios1" value="true" @if ($biosample->hold_release) checked @endif>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Hold (not viewable until the release of linked data)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hold_release" id="exampleRadios2" value="false" @if (!$biosample->hold_release) checked @endif>
                                            <label class="form-check-label" for="exampleRadios2">
                                                After the approval is passed, release immediately following curation
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        External Link <span class="text-danger"> **</span>
                                    </div>
                                    <div class="card-body">
                                        <table id="externalLinkTable" class="table w-100" data-toggle="table" data-mobile-responsive="true">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50%">Link Description</th>
                                                    <th scope="col" style="width: 45%">URL</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($externallinks as $ext_link)
                                                {{-- {{ $ext_link->link_url }} --}}
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="text" value="{{ $ext_link->link_description }}" name="external_link_description[]">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" value="{{ $ext_link->link_url }}" name="external_link_url[]">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger delete-row" title="Delete"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="button" id="btnAddExternalLink" class="btn btn-primary btn-sm">Add another link</button>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Comments
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <textarea class="form-control" id="comments" name="comments" rows="3">{{ $biosample->comments }}</textarea>
                                            <div id="commentsHelpBlock" class="form-text">
                                                Private comments to staff
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <p class="mb-0"><small><strong class="text-danger">*</strong> Required field </small></p>
                                <p class="mb-3"><small><strong class="text-danger">**</strong> Required when added</small></p>
                                <div class="d-flex align-items-center justify-content-end mb-3">
                                    <button type="button" class="btn btn-sm btn-primary btn-next-prev" id="btnNext" data-st-location="contentGeneralInfo" data-st-target="contentSampleInformation">
                                        Next <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contentSampleInformation" role="tabpanel" aria-labelledby="contentSampleInformation">
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Sample Type <span class="text-danger">*</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                {{-- <label for="sampleTypePackages" class="form-label fw-bold">Package</label> --}}
                                                <select id="sampleTypePackages" name="sample_type_packages_select" class="form-select" aria-label="Package" data-st-require="required">
                                                    <option selected disabled value="">Choose package</option>
                                                    @foreach ($packages as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    This field is required!
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                {{-- <label for="sampleType" class="form-label fw-bold">Sample Type</label> --}}
                                                <select id="sampleType" name="sample_type_select" class="form-select" aria-label="Sample Type" data-st-require="required">
                                                    <option selected disabled value="">Choose sample type</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    This field is required!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 d-none" id="cardSampleAttributes">
                                    <div class="card-header fs-6 fw-bold" id="cardSampleAttributesHeader">

                                    </div>
                                    <div class="card-body">
                                        <div id="formAttributes" class="row">
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <p class="mb-0"><small><strong class="text-danger">*</strong> Required field </small></p>
                                <p class="mb-3"><small><strong class="text-danger">**</strong> At least one field required</small></p>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <button type="button" class="btn btn-sm btn-danger btn-next-prev" data-st-target="contentGeneralInfo">
                                        <i class="bi bi-chevron-left"></i> Back
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary btn-next-prev" data-st-location="contentSampleInformation" data-st-target="contentPreview">
                                        Next <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contentPreview" role="tabpanel" aria-labelledby="contentPreview">
                                <div class="card">
                                    <div class="card-header fw-bold fs-6">
                                        Review Data
                                    </div>
                                    <div class="card-body">
                                        <table id="previewTable" class="table w-100" data-toggle="table" data-mobile-responsive="true">
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <hr class="mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <button type="button" class="btn btn-sm btn-danger btn-next-prev " data-st-target="contentSampleInformation">
                                        <i class="bi bi-chevron-left"></i> Back
                                    </button>
                                    <button id="btnSubmit" type="submit" class="btn btn-sm btn-primary">
                                        Submit <i class="bi bi-floppy-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Submitter Information</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-0">{{$submitter->name}}</h5>
                    <p class="card-text caption mb-0">{{$submitter->email}}</p>
                    <p class="card-text">{{$submitter->lab_name}} - {{$submitter->center_name}}</p>
                </div>
            </div>
        </div>
    </div>
{{-- <div class="col-lg-8">

    @livewire('create-biosample')
</div> --}}
@endsection
@push('js')
<script>
    var counterFundAgency = 0;
    var i = 0;
    let GLOBAL_ORGANISM = []
    let ORGANISM_PENDING_ID = null;
    $(document).ready(function() {
        $(".delete-row").on('click', function(e) {
            e.preventDefault()
            $(this).closest('tr').remove();
        });
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
            row += '<td><button type="button" class="btn btn-danger delete_row">remove</button></td></tr>';
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
                    rowsel = '<option value="">Select Funding Agency</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                        return rowsel;
                    });
                }
            });
            return rowsel;
        }

        function getSampleType(id) {
            $.ajax({
                url: "/dashboard/v2/biosamples/getSample/" + id,
                // type: "GET",
                async: false,
                success: function(response) {
                    rowsel = '<option selected disabled value="0">Choose sample type</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option title="' + value['description'] + '" value="' + value['id'] + '">' + value['name'] + '</option>';
                        return rowsel;
                    });
                },
                error: function(data) {
                    console.log(data.status + ':' + data.statusText, data.responseText);
                }
            });
            return rowsel;
        }

        function setAttributesInputs(attrs, name, value=null) {
            console.log(value)
            $("#cardSampleAttributes").removeClass("d-none")
            $("#cardSampleAttributesHeader").html(`${name} Attributes `)
            formAttributes.html("")
            // console.log(attrs["attributes"])
            let attributes = attrs["attributes"];
            let mandatories = attrs["attributesM"];
            let eithers = attrs["attributesE"];

            let values = (value && value['sample_attr']) ? value['sample_attr'] : [];
            let sample_attr_value = null;


            mandatories.forEach(mandatory => {
                if (mandatory.length !== 0) {
                    sample_attr_value = values.filter((value) => value.attributesample_id == mandatory)[0] ? values.filter((value) => value.attributesample_id == mandatory)[0]["value"] : ""
                    createInput(attributes.filter((attribute) => attribute.id == mandatory)[0], "required",sample_attr_value)
                }
                
                attributes = attributes.filter((attribute) => attribute.id != mandatory)
            });

            eithers.forEach(either => {
                if (either.length !== 0) {
                    sample_attr_value = values.filter((value) => value.attributesample_id == either)[0] ? values.filter((value) => value.attributesample_id == either)[0]["value"] : ""
                    createInput(attributes.filter((attribute) => attribute.id == either)[0], "either",sample_attr_value)
                }
                attributes = attributes.filter((attribute) => attribute.id != either)
            });

            attributes.forEach(attribute => {
                sample_attr_value = values.filter((value) => value.attributesample_id == attribute.id)[0] ? values.filter((value) => value.attributesample_id == attribute.id)[0]["value"] : ""
                createInput(attribute, "optional",sample_attr_value)
            })
        }

        function getAttributes(id, name) {
            let attributeResponse = null;
            let valueResponse = null;
            $.ajax({
                url: "/dashboard/v2/biosamples/getAttributes/" + id,
                // type: "GET",
                async: false,
                success: function(response) {
                    attributeResponse = response;
                    // console.log(response);
                    // setAttributesInputs(response, name)
                    // Nested AJAX call for the second URL to fetch values
                    $.ajax({
                        // getValueAttributes
                        url: "/dashboard/v2/biosamples/getValueAttributes/" + BIOSAMPLE_ID,
                        async: false,
                        success: function(value){
                            valueResponse = value;
                            setAttributesInputs(attributeResponse, name, valueResponse);
                        },
                        error: function(data) {
                            console.log("Error fetching values:", data.status + ':' + data.statusText, data.responseText);
                        }
                    })
                },
                error: function(data) {
                    console.log(data.status + ':' + data.statusText, data.responseText);
                }
            });
            return rowsel;
        }

        const formAttributes = $("#formAttributes");
        const BIOSAMPLE_ID = @json($biosample->id);
        const sampleTypePackages = $("#sampleTypePackages")
        sampleTypePackages.val("{{$sampletype->sampletype_package_id}}")
        const sampleType = $("#sampleType")
        sampleType.empty()
        sampleType.append(getSampleType(sampleTypePackages.val()))
        sampleType.val("{{$sampletype->id}}").trigger("change")
        // const attributesVal.val("{{ $sample_attr }}")
        getAttributes(sampleType.val(), $("#sampleType option:selected").text())
        const externalLinkTable = $("#externalLinkTable");
        const btnAddExternalLink = $("#btnAddExternalLink");

        btnAddExternalLink.on("click", function(e) {
            e.preventDefault()
            $("#externalLinkTable tbody").append(
                `
                    <tr>
                        <td>
                            <input class="form-control" type="text" name="external_link_description[]" data-st-require="required">
                            <div class="invalid-feedback">
                                This field cannot be empty!
                            </div>
                        </td>
                        <td>
                            <input class="form-control"  type="text" name="external_link_url[]" data-st-require="required">
                            <div class="invalid-feedback">
                                This field cannot be empty!
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger delete-row" title="Delete"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                `
            )
            $(".delete-row").on('click', function(e) {
                e.preventDefault()
                $(this).closest('tr').remove();
            });
        })

        sampleTypePackages.on("change", function(e) {
            sampleType.empty()
            sampleType.append(getSampleType(sampleTypePackages.val()))
        })

        sampleType.on("change", function(e) {
            getAttributes(sampleType.val(), $("#sampleType option:selected").text())
        })


        function decodeHTMLEntities(text) {
            return text.replaceAll(/[\u00A0-\u9999<>\&]/g, i => '&#' + i.charCodeAt(0) + ';').replaceAll('"', '&quot;');
        }


        function createInput(obj, requireType, value = null) {
            // console.log(obj.attr_name)
            const normalizedValue = (value === null || value === undefined) ? "" : value;
            let asterisk = requireType == "required" ? "<span class='text-danger'>* </span>" : requireType == "either" ? "<span class='text-danger'>** </span>" : ""
            let input = ""
            switch (obj.input_type_id) {
                case 1:
                    input = `<input data-st-require="${requireType}" value="${normalizedValue}" type="text" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                    break;
                case 2:
                    input = `<textarea data-st-require="${requireType}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">${normalizedValue}</textarea>`
                    break;
                case 3:
                    let options = ""
                    const rawListValue = (obj.list_value === null || obj.list_value === undefined) ? "" : String(obj.list_value);
                    rawListValue.split(",").filter(v => v !== "").forEach(element => {
                        options += `<option value="${element}" style="text-transform: capitalize;">${element.replace(/\b\w/g, function(l){ return l.toUpperCase() })}</option>`
                    });
                    input = `
                        <select class="form-select mb-3" data-st-require="${requireType}" id="${obj.attr_name}" name="${obj.attr_name}" aria-label="${obj.attr_text}">
                           ${options}
                        </select>
                    `
                    break;
                case 4:
                    input = `<input data-st-require="${requireType}" type="date" value="${normalizedValue}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`

                    break;
                case 5:
                    input = `<input data-st-require="${requireType}" type="text" value="${normalizedValue}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                    break;
                case 6:
                    input = `<input data-st-require="${requireType}" type="text" value="${normalizedValue}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                    break;

                default:
                    input = `<input data-st-require="${requireType}" type="text" value="${normalizedValue}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                    break;
            }
            if (requireType == "required") {
                input +=
                    `
                    <div class="invalid-feedback">
                        This field cannot be empty!
                    </div>
                    `
            }

            if (requireType == "either") {
                input +=
                    `
                    <div class="invalid-feedback">
                        At least one field required!
                    </div>
                    `
            }

            formAttributes.append(
                `
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="${obj.attr_name}" class="form-label fw-bold">${obj.attr_text+asterisk}</label>
                        <i class="bi bi-question-circle ms-1" tabindex="-1" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-custom-class="custom-popover" data-bs-html="true" data-bs-placement="right" data-bs-content="${decodeHTMLEntities(obj.description)}"></i>
                        ${input}
                    </div>
                </div>
                `
            )

            // Preselect value for normal <select> inputs
            if (obj.input_type_id == 3 && normalizedValue !== "") {
                $("#" + obj.attr_name).val(normalizedValue);
            }
            let popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            let popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
            if (obj.attr_name == "taxonomy_id") {
                $("#taxonomy_id").prop("readonly", true);
            }
            if (obj.attr_name == "organism") {
                ORGANISM_PENDING_ID = normalizedValue || null;

                // If this tab is currently visible, initialize immediately.
                // If it's hidden (Bootstrap tabs), Select2 may compute width=0 and look like it disappeared.
                if ($('#contentSampleInformation').hasClass('show') && $('#contentSampleInformation').hasClass('active')) {
                    ensureOrganismSelect2();
                }
            }

        }

        function ensureOrganismSelect2() {
            const $organism = $('#organism');
            if ($organism.length === 0) return;

            // Preserve current value if any
            const currentValue = $organism.val() || ORGANISM_PENDING_ID;

            // Re-init to fix width/visibility glitches when switching tabs
            if ($organism.hasClass('select2-hidden-accessible')) {
                $organism.select2('destroy');
            }

            $organism.select2({
                placeholder: "Select Organism",
                theme: "bootstrap-5",
                width: '100%',
                ajax: {
                    url: function(params) {
                        return '/dashboard/v2/biosamples/getOrganism/' + (params.term || '');
                    },
                    dataType: 'json',
                    type: "GET",
                    quietMillis: 50,
                    data: function(term) {
                        return {
                            term: term
                        };
                    },
                    processResults: function(data) {
                        GLOBAL_ORGANISM = data
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text,
                                    taxon_id: obj.taxon_id
                                };
                            })
                        };
                    },
                }
            });

            $organism.off('select2:select.organism').on("select2:select.organism", function(e) {
                $("#taxonomy_id").val(e.params.data.taxon_id)
            });

            if (currentValue) {
                $.ajax({
                    url: "/dashboard/v2/biosamples/getOrganismById/" + currentValue,
                    type: "GET",
                    success: function(data) {
                        if (!data) return;
                        const option = new Option(data.text, data.id, true, true);
                        $organism.append(option).trigger('change');
                        if (data.taxon_id) {
                            $("#taxonomy_id").val(data.taxon_id)
                        }
                    },
                    error: function() {
                        // leave blank if organism id no longer exists
                    }
                });
            }

            // Hard-set container width in case Bootstrap tabs caused 0-width calc
            $organism.next('.select2-container').css('width', '100%');
        }
        const formBioSample = $('#formBioSample')

        function getTableRow(label, value) {
            if (label == "sample_description") {
                label = "Biosample Description"
                value = document.querySelector('textarea[name=sample_description]').value
            } else if (label == "hold_release") {
                label = "Hold/Release"
                value = document.querySelector('input[name=hold_release]:checked').nextElementSibling.innerHTML
            } else if (label == "external_link_description[]" || label == "external_link_url[]") {
                if (document.querySelector("tr[data-st-trlabel='External Link']") == null) {
                    let externalLinkDesc = document.querySelectorAll("input[name='external_link_description[]']")
                    let externalLinkUrl = document.querySelectorAll("input[name='external_link_url[]']")
                    let li = ""
                    label = "External Link"
                    externalLinkDesc.forEach((element, index) => {
                        li += `<li><a href="${externalLinkUrl[index].value}">${element.value}</a></li>`
                    });
                    value = `<ul>
                        ${li}
                        </ul>
                    `
                } else {
                    return false
                }
            } else if (label == "comments") {
                label = "Comments"
            } else if (label == "sample_type_packages_select") {
                label = "Sample Type Package"
                value = document.querySelector('#sampleTypePackages option:checked').innerHTML
            } else if (label == "sample_type_select") {
                label = "Sample Type"
                value = document.querySelector('#sampleType option:checked').innerHTML
            } else if (label == "organism") {

                label = "Organism <span class='text-danger'>*</span>"
                value = document.querySelector('#organism option:checked').innerHTML
            } else {
                label = document.querySelector(`[name=${label}]`).previousSibling.previousSibling.previousElementSibling.innerHTML
            }
            return (
                `
                <tr data-st-trlabel="${label}">
                    <td>
                        <strong>${label}</strong>
                    </td>
                    <td>
                        ${value}
                    </td>
                </tr>
            `
            )
        }

        function serializeForm() {
            let formData = formBioSample.serializeArray()
            $("#previewTable tbody").html("")
            let externalLinkDesc = document.querySelectorAll("input[name='external_link_description[]']")
            let externalLinkUrl = document.querySelectorAll("input[name='external_link_url[]']")

            formData.forEach(element => {
                if (element.name != "_method" && element.name != "_token") {
                    console.log(getTableRow(element.name, element.value == "" ? "-" : element.value))
                    $("#previewTable tbody").append(getTableRow(element.name, element.value == "" ? "-" : element.value))
                }
            });
            console.log("formData", formData)
        }


        function activeTab(tab) {
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        }

        function validate(tabName) {
            if (tabName == null) {
                return true
            }
            let tab = document.getElementById(tabName)
            let allFormRequired = tab.querySelectorAll('[data-st-require="required"]')
            let trueState = []
            allFormRequired.forEach(element => {
                if (element.value == "") {
                    element.classList.add("is-invalid")
                    element.nextElementSibling.style.display = "block"
                    trueState.push(false)
                } else {
                    element.classList.remove("is-invalid")
                    element.nextElementSibling.style.display = "none"
                    trueState.push(true)
                }
            });

            let allFormEither = tab.querySelectorAll('[data-st-require="either"]')
            if (allFormEither.length > 0) {
                let eitherStateArray = []
                allFormEither.forEach(element => {
                    if (element.value == "") {
                        eitherStateArray.push(false)
                    } else {
                        eitherStateArray.push(true)
                    }
                });

                let eitherOk = !eitherStateArray.every(v => v === false);

                if (!eitherOk) {
                    allFormEither.forEach(element => {
                        element.classList.add("is-invalid")
                        element.nextElementSibling.style.display = "block"
                    });
                } else {

                    allFormEither.forEach(element => {
                        element.classList.remove("is-invalid")
                        element.nextElementSibling.style.display = "none"
                    });
                }
                trueState.push(eitherOk)
            }



            return trueState.every(v => v === true);
        }


        $('#tabPreview').on('shown.bs.tab', function(e) {
            serializeForm()
        });

        // When user navigates back to Sample Information, Select2 needs a refresh
        $('#tabSampleInformation').on('shown.bs.tab', function() {
            ensureOrganismSelect2();
        });

        let btnPrevNext = document.querySelectorAll(".btn-next-prev")
        btnPrevNext.forEach(element => {
            element.addEventListener("click", function(e) {
                e.preventDefault()
                if (validate(element.dataset.stLocation)) {
                    activeTab(element.dataset.stTarget)
                }

            })
        });
    });
</script>

@endpush