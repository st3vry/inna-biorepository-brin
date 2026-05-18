@extends('dashboard.layouts.main')
@section('title', 'Create Biosample')
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" action="/dashboard/v2/biosamples" method="POST" novalidate id="formBioSample">
                        @method('post')
                        @csrf
                        <input type="hidden" id="draftId" name="draft_id" value="">
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
                                    Sample Attributes
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
                                        <textarea class="form-control" id="sample_description" name="sample_description" placeholder="Biosample description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Release <span class="text-danger">*</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hold_release" id="exampleRadios1" value="true" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Hold (not viewable until the release of linked data)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="hold_release" id="exampleRadios2" value="false">
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
                                                {{-- <tr>
                                                    <td>
                                                        <input class="form-control" type="text" name="external_link_description[]">
                                                    </td>
                                                    <td>
                                                        <input class="form-control"  type="text" name="external_link_url[]">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger delete-row" title="Delete"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                        <button id="btnAddExternalLink" class="btn btn-primary btn-sm">Add another link</button>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Comments
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                                            <div id="commentsHelpBlock" class="form-text">
                                                Private comments to staff
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-0" >
                                <p class="mb-0"><small><strong class="text-danger">*</strong> Required field </small></p>
                                <p class="mb-3"><small><strong class="text-danger">**</strong> Required when added</small></p>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <button class="btn btn-sm btn-primary btn-next-prev" id="btnNext" data-st-location="contentGeneralInfo" data-st-target="contentSampleInformation">
                                        Next <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contentSampleInformation" role="tabpanel" aria-labelledby="contentSampleInformation">
                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Bioproject <span class="text-danger">*</span>
                                    </div>
                                    <div class="card-body">
                                        <select class="form-control select2" id="bioproject_id" name="bioproject_id" required>
                                            <option value="">Select a Bioproject</option>
                                            @foreach($bioprojects as $bioproject)
                                                <option value="{{ $bioproject->id }}">{{ $bioproject->accession }} - {{ $bioproject->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header fw-bold fs-6">
                                        Organism <span class="text-danger">*</span>
                                    </div>
                                    <div class="card-body">
                                        <input class="form-control" type="text" name="organism_data" readonly id="organism_data"
                                        data-bs-toggle="modal" data-bs-target="#taxonModal"
                                        placeholder="Click to search organism..." style="cursor: pointer;">
                                    <input type="hidden" name="organism_detail">
                                    <input type="hidden" name="organism_name">
                                    <input type="hidden" name="taxonomy_id">
                                    </div>
                                </div>
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
                                                <select id="sampleType" name="sample_type_select"  class="form-select" aria-label="Sample Type" data-st-require="required">
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
                                <hr class="mb-0" >
                                <p class="mb-0"><small><strong class="text-danger">*</strong> Required field </small></p>
                                <p class="mb-3"><small><strong class="text-danger">**</strong> At least one field required</small></p>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <button class="btn btn-sm btn-danger btn-next-prev" data-st-target="contentGeneralInfo">
                                        <i class="bi bi-chevron-left"></i> Back
                                    </button>
                                    <button class="btn btn-sm btn-primary btn-next-prev"  data-st-location="contentSampleInformation" data-st-target="contentPreview">
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
                                <hr class="mb-3" >
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <button class="btn btn-sm btn-danger btn-next-prev " data-st-target="contentSampleInformation">
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
                    <div class="d-flex justify-content-between gap-3">
                        <button id="btnSaveDraft" type="button" class="btn btn-outline-success w-100 btn-sm">
                            Save Draft <i class="bi bi-save"></i>
                        </button>
                        @isset($draft)
                        <button id="btnDiscardDraft" type="button" class="btn btn-outline-danger w-100 btn-sm">
                            Discard Draft <i class="bi bi-trash"></i>
                        </button>
                        @endisset
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="fw-bold">Submitter Information</h5>
                    <hr>
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

@include('dashboard.layouts.taxonmodal')
@endsection



@push('js')
<script>
    $('#bioproject_id').select2({
        placeholder: "Select a Bioproject",
        theme: "bootstrap-5",
        width: '100%'
    });

    var counterFundAgency = 0;
    var i = 0;
    let GLOBAL_ORGANISM = []
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
                    rowsel = '<option value="">Select Funding Agency</option>'
                    $.each(response, function(key, value) {
                        rowsel += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                        return rowsel;
                    });
                }
            });
            return rowsel;
        }

        // Fetch sample types for a package and populate the `#sampleType` select.
        // Returns the jqXHR promise so callers can chain .done/.fail.
        function getSampleType(id, selectedId) {
            return $.ajax({
                url: "/dashboard/v2/biosamples/getSample/" + id,
                method: 'GET',
                dataType: 'json'
            }).done(function(response) {
                sampleType.empty();
                sampleType.append('<option selected disabled value="">Choose sample type</option>');
                $.each(response, function(key, value) {
                    const $opt = $('<option>').attr('title', value['description']).val(value['id']).text(value['name']);
                    sampleType.append($opt);
                });
                if (selectedId) {
                    sampleType.val(selectedId);
                }
            }).fail(function(xhr) {
                console.log('Error fetching sample types:', xhr.status, xhr.statusText);
            });
        }



        function setAttributesInputs(attrs, name) {
            $("#cardSampleAttributes").removeClass("d-none")
            $("#cardSampleAttributesHeader").html(`${name} Attributes `)
            formAttributes.html("")
            let attributes = attrs["attributes"];
            let mandatories = attrs["attributesM"];
            let eithers = attrs["attributesE"];
            mandatories.forEach(mandatory => {
                if (mandatory.length !== 0) {
                    createInput(attributes.filter((attribute) => attribute.id == mandatory)[0], "required")
                }
                attributes = attributes.filter((attribute) => attribute.id != mandatory)
            });

            eithers.forEach(either => {
                if (either.length !== 0) {
                    createInput(attributes.filter((attribute) => attribute.id == either)[0],"either")
                }
                attributes = attributes.filter((attribute) => attribute.id != either)
            });

            attributes.forEach(attribute => {
                createInput(attribute, "optional")
            })
        }

        // Fetch attribute definitions for a sample type and populate inputs.
        // Returns the jqXHR promise so callers can wait for completion.
        function getAttributes(id, name) {
            return $.ajax({
                url: "/dashboard/v2/biosamples/getAttributes/" + id,
                method: 'GET',
                dataType: 'json'
            }).done(function(response) {
                setAttributesInputs(response, name);
            }).fail(function(xhr) {
                console.log('Error fetching attributes:', xhr.status, xhr.statusText);
            });
        }

        const sampleTypePackages = $("#sampleTypePackages")
        const sampleType = $("#sampleType")
        const formAttributes =$("#formAttributes");
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
                            <button class="btn btn-danger delete-row" title="Delete"><i class="bi bi-trash"></i></button>
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
            const pkgId = sampleTypePackages.val();
            if (!pkgId) return;
            // populate sampleType asynchronously
            getSampleType(pkgId).done(function() {
                // clear attributes when switching package
                $('#cardSampleAttributes').addClass('d-none');
                formAttributes.html('');
            });
        })

        sampleType.on("change",function(e) {
            getAttributes(sampleType.val() , $( "#sampleType option:selected" ).text())
        })


        function decodeHTMLEntities(text) {
            return text.replaceAll(/[\u00A0-\u9999<>\&]/g, i => '&#'+i.charCodeAt(0)+';').replaceAll('"', '&quot;');
        }


        function createInput(obj, requireType) {
            let asterisk = requireType == "required" ? "<span class='text-danger'>* </span>" : requireType == "either" ? "<span class='text-danger'>** </span>" : ""
            let input = ""
            if (obj.attr_name != "organism" && obj.attr_name != "taxonomy_id" && obj.attr_name != "bioproject_id") {
                switch (obj.input_type_id) {
                    case 1:
                        input = `<input data-st-require="${requireType}" type="text" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                        break;
                    case 2:
                        input = `<textarea data-st-require="${requireType}" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}"></textarea>`
                        break;
                    case 3:
                        let options = ""
                        obj.list_value.split(",").forEach(element => {
                            options += `<option value="${element}" style="text-transform: capitalize;">${element.replace(/\b\w/g, function(l){ return l.toUpperCase() })}</option>`
                        });
                        input = `
                            <select class="form-select mb-3" data-st-require="${requireType}" id="${obj.attr_name}" name="${obj.attr_name}" aria-label="${obj.attr_text}">
                            ${options}
                            </select>
                        `
                        break;
                    case 4:
                        input = `<input data-st-require="${requireType}" type="date" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`

                        break;
                    case 5:
                        input = `<input data-st-require="${requireType}" type="text" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                        break;
                    case 6:
                        input = `<input data-st-require="${requireType}" type="text" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
                        break;

                    default:
                        input = `<input data-st-require="${requireType}" type="text" class="form-control" id="${obj.attr_name}" name="${obj.attr_name}">`
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
                let popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
                let popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
                // if (obj.attr_name == "taxonomy_id")  {
                //     $("#taxonomy_id").prop( "readonly", true );
                // }
                // if (obj.attr_name == "organism") {
                //     let organismSelect = $('#organism').select2({
                //         placeholder:"Select Organism",
                //         theme: "bootstrap-5",
                //         width: '100%',
                //         ajax: {
                //             url: function (params) {
                //                 console.log("params",params)
                //                 return '/dashboard/v2/biosamples/getOrganism/' + params.term;
                //             },
                //             dataType: 'json',
                //             type: "GET",
                //             quietMillis: 50,
                //             data: function (term) {
                //                 console.log("term",term)
                //                 return {
                //                     term: term
                //                 };
                //             },
                //             processResults: function (data) {
                //                 GLOBAL_ORGANISM = data
                //                 console.log("DATA", GLOBAL_ORGANISM)
                //                 return {
                //                     results:$.map(data, function(obj) {
                //                         return { id: obj.id, text: obj.text, taxon_id: obj.taxon_id };
                //                     })
                //                 };
                //             },
                //         }
                //     });

                //     organismSelect.on("select2:select", function (e) {
                //         $("#taxonomy_id").val( e.params.data.taxon_id)
                //     });
                // }
            }
            
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
                if (document.querySelector("tr[data-st-trlabel='External Link']")== null) {
                    let externalLinkDesc = document.querySelectorAll("input[name='external_link_description[]']")
                    let externalLinkUrl = document.querySelectorAll("input[name='external_link_url[]']")
                    let li = ""
                    label = "External Link"
                    externalLinkDesc.forEach((element, index) => {
                        li +=`<li><a href="${externalLinkUrl[index].value}">${element.value}</a></li>`
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
            } else if (label == "organism_data") {
                label = "Organism <span class='text-danger'>*</span>"
                value = document.querySelector('#organism_data').value
            } else if (label == "bioproject_id") {
                label = "Bioproject <span class='text-danger'>*</span>"
                value = document.querySelector('#bioproject_id option:checked').innerHTML
            } else {
                if (label == "organism_detail" || label == "organism_name" || label == "taxonomy_id") {
                    return false
                }
                label =  document.querySelector(`[name=${label}]`).previousSibling.previousSibling.previousElementSibling.innerHTML
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

        function serializeForm(){
            let formData = formBioSample.serializeArray()
            $("#previewTable tbody").html("")
            let externalLinkDesc = document.querySelectorAll("input[name='external_link_description[]']")
            let externalLinkUrl = document.querySelectorAll("input[name='external_link_url[]']")

            formData.forEach(element => {
                if (element.name != "_method" && element.name != "_token" && element.name != "draft_id") {
                    console.log(getTableRow(element.name, element.value == "" ? "-" :element.value ))
                    $("#previewTable tbody").append(getTableRow(element.name, element.value == "" ? "-" :element.value ))
                }
            });
        }


        function activeTab(tab){
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


        $('#tabPreview').on('shown.bs.tab', function (e) {
            serializeForm()
        });

        let btnPrevNext =  document.querySelectorAll(".btn-next-prev")
        btnPrevNext.forEach(element => {
            element.addEventListener("click", function(e) {
                e.preventDefault()
                if (validate(element.dataset.stLocation)) {
                    activeTab(element.dataset.stTarget)
                }

            })
        });

        $('#btnDiscardDraft').on('click', function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to discard the draft? This action cannot be undone.")) {
                const draftId = $('#draftId').val();
                if (!draftId) {
                    showAjaxAlert("No draft to discard.", "warning");
                    return;
                }
                $.ajax({
                    url: "/dashboard/v2/biosamples/draft/" + draftId + "/discard",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status === "OK") {
                            $('#draftId').val('');
                            showAjaxAlert("Draft discarded", "success");
                            location.reload();
                        } else {
                            showAjaxAlert("Unable to discard draft: " + (res.message || 'error'), "danger");
                        }
                    },
                    error: function(xhr) {
                        showAjaxAlert("Error discarding draft: " + xhr.statusText, "danger");
                    }
                });
            }
        });

        $('#btnSaveDraft').on('click', function(e) {
            e.preventDefault();
            const form = $('#formBioSample');
            const formData = form.serializeArray();
            // convert to object
            const payload = {};
            formData.forEach(item => {
                const rawName = item.name;
                const value = item.value;
                // support inputs named like `field[]` -> store under `field` as an array
                const arrayMatch = rawName.match(/(.+)\[\]$/);
                if (arrayMatch) {
                    const base = arrayMatch[1];
                    if (!payload[base]) payload[base] = [];
                    payload[base].push(value);
                    return;
                }

                // fallback: multiple inputs with same name (without []), e.g. repeated names
                if (payload[rawName] !== undefined) {
                    if (!Array.isArray(payload[rawName])) payload[rawName] = [payload[rawName]];
                    payload[rawName].push(value);
                } else {
                    payload[rawName] = value;
                }
            });

            const draftId = $('#draftId').val();

            $.ajax({
                // use a same-origin relative path to avoid protocol/host mismatches (https vs http)
                
                //url: "{{ route('biosamples.draft.save') }}",
                url: "/dashboard/v2/biosamples/draft",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    draft_id: draftId,
                    title: payload.title || '',
                    data: payload
                },
                success: function(res) {
                    if (res.status === "OK") {
                        $('#draftId').val(res.draft_id);
                        showAjaxAlert("Draft saved", "success");
                    } else {
                        showAjaxAlert("Unable to save draft: " + (res.message || 'error'), "danger");
                    }
                },
                error: function(xhr) {
                    showAjaxAlert("Error saving draft: " + xhr.statusText, "danger");
                }
            })
        });
        @if(!empty($draft))
            // Load draft data
            const draftData = {!! json_encode($draft->data) !!};

            // helper to populate non-dependent fields (will be called after attributes are ready)
            function populateDraftFields() {
                for (const [key, value] of Object.entries(draftData)) {
                    if (['sample_type_packages_select','sample_type_select'].includes(key)) {
                        // skip package/sample type here (handled separately)
                        continue;
                    }
                    // handle external link arrays (descriptions and urls)
                    if (key === "external_link_description" && Array.isArray(value)) {
                        // ensure enough rows exist
                        const existingDesc = document.querySelectorAll("input[name='external_link_description[]']").length;
                        for (let i = existingDesc; i < value.length; i++) {
                            $("#btnAddExternalLink").click();
                        }
                        // populate descriptions
                        const descInputs = document.querySelectorAll("input[name='external_link_description[]']");
                        for (let i = 0; i < value.length; i++) {
                            if (descInputs[i]) descInputs[i].value = value[i];
                        }
                        continue;
                    }
                    if (key === "external_link_url" && Array.isArray(value)) {
                        const urlInputs = document.querySelectorAll("input[name='external_link_url[]']");
                        for (let i = 0; i < value.length; i++) {
                            if (urlInputs[i]) urlInputs[i].value = value[i];
                        }
                        continue;
                    }
                    const field = document.querySelector(`[name="${key}"]`);
                    if (field) {
                        // If this is a Select2 field that loads options via AJAX (e.g. organism),
                        // the saved value may not have an <option> in the DOM. Handle that
                        // by trying to fetch the display text and appending a new option.
                        if ($(field).hasClass('select2-hidden-accessible')) {
                            console.log("select2 field", key, value);
                            const $f = $(field);
                            const val = value;
                            // if option already exists, just set it
                            if ($f.find(`option[value="${val}"]`).length) {
                                $f.val(val).trigger('change');
                            } else {
                                // attempt to fetch the display text from server (best-effort)
                                // Many Select2 AJAX endpoints accept the id as a term and return the matching record.
                                // We'll try the organism endpoint first (used by this form). If it fails,
                                // fall back to adding the raw id as text.
                                $.ajax({
                                    url: "/dashboard/v2/biosamples/getOrganism/" + encodeURIComponent(val),
                                    method: 'GET',
                                    dataType: 'json'
                                }).done(function(resp) {
                                    let text = val;
                                    let taxon = null;
                                    if (Array.isArray(resp) && resp.length > 0) {
                                        // prefer returned text fields
                                        text = resp[0].text || resp[0].name || text;
                                        taxon = resp[0].taxon_id || null;
                                    }
                                    const newOption = new Option(text, val, true, true);
                                    $f.append(newOption).trigger('change');
                                    // if an associated taxonomy id was returned, set it
                                    if (taxon) {
                                        $('#taxonomy_id').val(taxon);
                                    }
                                }).fail(function() {
                                    // fallback: create an option with the id as label
                                    const newOption = new Option(val, val, true, true);
                                    $f.append(newOption).trigger('change');
                                });
                            }
                        } else {
                            if (field.tagName === 'SELECT') {
                                field.value = ` ${value}`;
                            } else {
                                field.value = value;
                            }
                        }
                    }
                }
                // finally set draft id
                $('#draftId').val("{{ $draft->id }}");
            }

            // after setting simple fields, ensure sample type package and selected sample type are populated
            if (draftData.sample_type_packages_select) {
                sampleTypePackages.val(draftData.sample_type_packages_select);
                console.log("package", draftData.sample_type_packages_select)
                // sampleTypePackages.trigger('change');
                // fetch sample types and select the saved value (if any)
                getSampleType(draftData.sample_type_packages_select, draftData.sample_type_select).done(function() {
                    if (draftData.sample_type_select) {
                        sampleType.val(draftData.sample_type_select);
                        // populate attributes for selected sample type and then populate other fields
                        getAttributes(sampleType.val(), $("#sampleType option:selected").text()).done(function() {
                            populateDraftFields();
                            
                        });
                    } else {
                        // attributes not dependent on sample type, populate fields now
                        populateDraftFields();
                    }
                });
            } else {
                // no package/sample-type dependency: populate immediately
                populateDraftFields();
            }
            
        @endif
    });
</script>

@endpush
