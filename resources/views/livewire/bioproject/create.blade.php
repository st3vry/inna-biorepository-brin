<div class="container-fluid">
    <div class="row">
        <form wire:submit.prevent="submitForm">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-success me-2" wire:click="saveDraft" wire:loading.attr="disabled">
                        <span wire:loading.remove>Save Draft 
                            <i class="ti ti-device-floppy"></i>
                        </span>
                        <span wire:loading>Saving...</span>
                    </button>
                    @if($draftId)
                    {{-- <button type="button" class="btn btn-sm btn-outline-info me-2" wire:click="loadDraft({{ $draftId }})">Reload Draft</button> --}}
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDiscardBioprojectDraft()" wire:loading.attr="disabled">
                        <span wire:loading.remove>Discard Draft
                            <i class="ti ti-trash"></i>
                        </span>
                        {{-- <span wire:loading>Discarding...</span> --}}
                    </button>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div>
                    @if(!empty($successMsg))
                    <div class="alert alert-success">
                        {{ $successMsg }}
                    </div>
                    @endif
                    <ul id="nav-steps" class="nav nav-pills mb-2 nav-justified bg-light p-1 rounded">
                        <li class="nav-item">
                            <a href="#step-1" wire:click="back(1)" class="nav-link {{ $currentStep == 1 ? 'active' : '' }}  {{ $currentStep < 1 ? 'disabled' : '' }}">Submitter</a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-2" wire:click="back(2)" class="nav-link {{ $currentStep == 2 ? 'active' : ''  }} {{ $currentStep < 2 ? 'disabled' : '' }}">General Info</a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-3" wire:click="back(3)" class="nav-link {{ $currentStep == 3 ? 'active' : ''  }} {{ $currentStep < 3 ? 'disabled' : '' }}">Project Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-4" wire:click="back(4)" class="nav-link {{ $currentStep == 4 ? 'active' : '' }} {{ $currentStep < 4 ? 'disabled' : '' }}">Target</a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-5" wire:click="back(5)" class="nav-link {{ $currentStep == 5 ? 'active' : '' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Publication</a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-6" class="nav-link {{ $currentStep == 6 ? 'active' : 'disabled' }} {{ $currentStep < 6 ? 'disabled' : '' }}">Preview</a>
                        </li>
                    </ul>
                    <div class="progress mb-2"  style="height: 4px;">
                        <div id="wizard-progress"  class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
                    <div class="col-md-12">
                        <h4>Submitter Info</h4>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Submitter</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('submitter_name') is-invalid @enderror" wire:model="submitter_name" id="submitter_name" name="submitter_name" value="{{old('submitter_name')}}" disabled>
                                    @error('submitter_name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('submitter_email') is-invalid @enderror" wire:model="submitter_email" id="submitter_email" name="submitter_email" value="{{old('submitter_email')}}" disabled>
                                    @error('submitter_email')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lab" class="form-label">Lab <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('submitter_lab') is-invalid @enderror" wire:model="submitter_lab_name" id="submitter_lab_name" name="submitter_lab_name`" value="{{old('submitter_lab_name')}}" disabled>
                                    <input type="text" class="form-control @error('submitter_lab') is-invalid @enderror" wire:model="submitter_lab" id="submitter_lab" name="submitter_lab" value="{{old('submitter_lab')}}" hidden>
                                    @error('submitter_lab')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="center" class="form-label">Center <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center_name" id="submitter_center_name" name="submitter_center_name" value="{{old('submitter_center_name')}}" disabled>
                                    <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center" id="submitter_center" name="submitter_center" value="{{old('submitter_center')}}" hidden>
                                    @error('submitter_center')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Release <font color="red">*</font>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <!-- <label for="hold_release" class="form-label">-</label> -->
                                    <!-- <div class="row"> -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="true" @if (old('hold_release')==true) ) checked @endif>
                                        <label class="form-check-label">Hold (not viewable until the release of linked data)</label>
                                    </div>


                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="false" @if (old('hold_release')==false) ) checked @endif>
                                        <label class="form-check-label">Release immediately (After the approval is passed, release immediately following curation) </label>
                                    </div>
                                    <!-- </div> -->
                                    @error('hold_release')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary " wire:click="firstStepSubmit" type="button">Next</button>
                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
                    <div class="col-md-12">
                        <h4>General Info</h4>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Project Description</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" id="title" name="title" value="{{old('title')}}">
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <font color="red">*</font></label>
                                    <textarea class="form-control" id="description" name="description" wire:model="description" rows="3">{{old('description')}}</textarea>

                                    @error('description')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="relevance" class="form-label">Relevance <font color="red">*</font></label>
                                    <select class="form-select select2" name="relevance_id" id="relevance_id" wire:model="relevance_id">
                                        <option value="">Relevance</option>
                                        @foreach ($relevances as $relevance )
                                        <option value="{{$relevance->id}}" @if (old('relevance_id')==$relevance->id) selected @endif>{{$relevance->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($relevance_id==7)
                                    <label for="reldesc" class="form-label">Relevance Description <font color="red">*</font></label>
                                    <input type="text" class="form-control @error('reldesc') is-invalid @enderror" wire:model="reldesc" id="reldesc" name="reldesc" value="{{old('reldesc')}}">
                                    @error('reldesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('relevance_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Umbrella Bioproject</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="umbrella" class="form-label">Umbrella Project</label>
                                    <select class="form-select select2" name="umbproject_id" wire:model="umbproject_id" id="umbproject_id">
                                        <option value="">Umbrella Project</option>
                                        @foreach ($umbrellas as $umbrella )
                                        <option value="{{$umbrella->id}}" @if (old('umbproject_id')==$umbrella->id) selected @endif> {{$umbrella->accession}} &mdash; {{$umbrella->title}}</option>
                                        @endforeach
                                    </select>

                                    @error('umbproject_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>External Links</h5>
                            </div>
                            <div class="card-body mb-3">
                                <table id="add_table_externallink" class="table" data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                        <tr>
                                            <th scope="col">Link Description</th>
                                            <th scope="col">Link URL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($externallinks as $index => $externallink)
                                        <tr>
                                            <td>
                                                <input type="text" name="externallinks[{{$index}}][link_description]" class="form-control" value="{{$externallink['link_description']}}" wire:model="externallinks.{{$index}}.link_description">
                                                @error('externallinks.*.link_description')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="externallinks[{{$index}}][link_url]" class="form-control" value="{{$externallink['link_url']}}" wire:model="externallinks.{{$index}}.link_url">
                                                @error('externallinks.*.link_url')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-danger delete_row" wire:click.prevent="removeExternalLink({{$index}})">remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addExternalLink">+ Add Another Link</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Grants</h5>
                            </div>
                            <div class="card-body">
                                <!-- <div class="card card-outline card-info collapsed-card mb-3"> -->
                                <!-- <div class="card-header">
                                        <h6 class="card-title">Grants</h6>
                                    </div>
                                    <div class="card-body mb-3"> -->
                                <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                        <tr>
                                            <th scope="col">Agency</th>
                                            <th scope="col">Program</th>
                                            <th scope="col">Grant Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($grants as $index => $grant)
                                        <tr>
                                            <td>
                                                <select class="form-select select2" name="grants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
                                                    <option value="0">Funding Agency</option>
                                                    @foreach ($fundagencies as $fundagency )
                                                    <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('grants.*.fundagency_id')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="grant[{{$index}}][grant_program]" class="form-control" value="{{$grant['grant_program']}}" wire:model="grants.{{$index}}.grant_program">
                                                @error('grants.*.grant_program')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="grant[{{$index}}][grant_title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                                                @error('grants.*.grant_title')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-danger delete_row" wire:click.prevent="removeGrant({{$index}})">remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addGrant">+ Add Another Grant</button>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <!-- /.card-body -->
                                <!-- </div> -->
                                <!-- /.card -->
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Consortium</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="consortium_id" class="form-label">Consortium</label>
                                    <select class="form-select select2" name="consortium_id" id="consortium_id" wire:model="consortium_id">
                                        <option value="">Consortium</option>
                                        @foreach ($consortia as $consortium )
                                        <option value="{{$consortium->id}}" @if (old('consortium_id')==$consortium->id) selected @endif>{{$consortium->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('consortium_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(1)">Back</button>
                        <button class="btn btn-primary pull-right" type="button" wire:click="secondStepSubmit">Next</button>

                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Project Data Type <font color="red">*</font></h5>
                            </div>
                            <div class="card-body">
                                @foreach ($datatypes->chunk(6) as $row)
                                <div class="row">
                                    @foreach ( $row as $datatype)
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="data_type_id[]" wire:model="data_type_id.{{ $datatype->id }}" value="{{$datatype->id}}" @if(is_array(old('data_type _id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
                                            <label class="form-check-label">{{$datatype->name}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                @if(is_array($data_type_id) && in_array(10,$data_type_id))
                                <!-- {{print_r($data_type_id)}} -->
                                <label for="datatypedesc" class="form-label">Other data type description</label>
                                <input type="text" class="form-control @error('datatypedesc') is-invalid @enderror" wire:model="datatypedesc" id="datatypedesc" name="datatypedesc" value="{{old('datatypedesc')}}">
                                @error('datatypedesc')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @endif
                                @error('data_type_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Sample scope/Material/Capture/Methodology</h5>
                            </div>
                            <div class="card-body">

                                <!-- sample scope -->
                                <div class="mb-3">
                                    <label for="samplescope" class="form-label">Sample scope <font color="red">*</font></label>
                                    <select class="form-select select2" name="samplescope_id" id="samplescope_id" wire:model="samplescope_id">
                                        <option value="">Sample scope</option>
                                        @foreach ($samplescopes as $samplescope )
                                        <option value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id) selected @endif>{{$samplescope->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($samplescope_id==7)
                                    <label for="samplescopedesc" class="form-label">Other sample scope description</label>
                                    <input type="text" class="form-control @error('matdesc') is-invalid @enderror" wire:model="samplescopedesc" id="samplescopedesc" name="samplescopedesc" value="{{old('samplescopedesc')}}">
                                    @error('samplescopedesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('samplescope_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <!-- material -->
                                <div class="mb-3">
                                    <label for="material" class="form-label">Material <font color="red">*</font></label>
                                    <select class="form-select select2" name="material_id" id="material_id" wire:model="material_id">
                                        <option value="">Material</option>
                                        @foreach ($materials as $material )
                                        <option value="{{$material->id}}" @if (old('material_id')==$material->id) selected @endif>{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($material_id==7)
                                    <label for="matdesc" class="form-label">Other material description</label>
                                    <input type="text" class="form-control @error('matdesc') is-invalid @enderror" wire:model="matdesc" id="matdesc" name="matdesc" value="{{old('matdesc')}}">
                                    @error('matdesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('material_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <!-- capture -->
                                <div class="mb-3">
                                    <label for="capture" class="form-label">Capture <font color="red">*</font></label>
                                    <select class="form-select select2" name="capture_id" id="capture_id" wire:model="capture_id">
                                        <option value="">Capture</option>
                                        @foreach ($captures as $capture )
                                        <option value="{{$capture->id}}" @if (old('capture_id')==$capture->id) selected @endif>{{$capture->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($capture_id==6)
                                    <label for="capdesc" class="form-label">Other capture description</label>
                                    <input type="text" class="form-control @error('capdesc') is-invalid @enderror" wire:model="capdesc" id="capdesc" name="capdesc" value="{{old('capdesc')}}">
                                    @error('capdesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('capture_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <!-- methodology -->
                                <div class="mb-3">
                                    <label for="methodology" class="form-label">Methodology <font color="red">*</font></label>
                                    <select class="form-select select2" name="methodology_id" id="methodology_id" wire:model="methodology_id">
                                        <option value="">Methodology</option>
                                        @foreach ($methodologies as $methodology )
                                        <option value="{{$methodology->id}}" @if (old('methodology_id')==$methodology->id) selected @endif>{{$methodology->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($methodology_id==4)
                                    <label for="metdesc" class="form-label">Other methodology description</label>
                                    <input type="text" class="form-control @error('metdesc') is-invalid @enderror" wire:model="metdesc" id="metdesc" name="metdesc" value="{{old('metdesc')}}">
                                    @error('metdesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('methodology_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Objectives <font color="red">*</font></h5>
                            </div>
                            <div class="card-body">
                                @foreach ($objectives->chunk(6) as $row)
                                <div class="row">
                                    @foreach ( $row as $objective)
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="objective_id[]" wire:model="objective_id.{{ $objective->id }}" value="{{$objective->id}}" @if(is_array(old('objective_id')) && in_array($objective->id, old('objective_id'))) checked @endif>
                                            <label class="form-check-label">{{$objective->name}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                @if(is_array($objective_id) && in_array(11,$objective_id))
                                <!-- {{print_r($objective_id)}} -->
                                <label for="objdesc" class="form-label">Other objective description</label>
                                <input type="text" class="form-control @error('objdesc') is-invalid @enderror" wire:model="objdesc" id="objdesc" name="objdesc" value="{{old('objdesc')}}">
                                @error('objdesc')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @endif
                                @error('objective_id')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">Back</button>
                        <button class="btn btn-primary pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
                    <div class="col-md-12">
                        <h4>Target</h4>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Organism Information</h6>
                            </div>
                            <div class="card-body mb-3">
                                <div class="mb-3">
                                    <label for="organism_id" class="form-label">Organism <font color="red">*</font></label>
                                    <select class="form-select select2" name="organism_id" id="organism_id" wire:model="organism_id">
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
                                    <input class="form-check-input" type="checkbox" name="novel_org" wire:model="novel_org" value="novel_org">
                                    <label class="form-check-label">Novel</label>
                                </div>
                                <div class="mb-3">
                                    <label for="novel_desc" class="form-label">Novel Description</label>
                                    <textarea class="form-control" id="novel_desc" name="novel_desc" wire:model="novel_desc" rows="3" @if ($novel_org==false) disabled @endif>{{old('novel_desc')}}</textarea>

                                    @error('novel_desc')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sbc" class="form-label">Strain, Breed, Cultivar</label>
                                    <input type="text" class="form-control @error('sbc') is-invalid @enderror" wire:model="sbc" id="sbc" name="sbc" value="{{old('sbc')}}">
                                    @error('sbc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="isolate" class="form-label">Isolate name or label</label>
                                    <input type="text" class="form-control @error('isolate') is-invalid @enderror" wire:model="isolate" id="isolate" name="isolate" value="{{old('isolate')}}">
                                    @error('isolate')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="org_desc" class="form-label">Organism Description</label>
                                    <textarea class="form-control" id="org_desc" name="org_desc" wire:model="org_desc" rows="3">{{old('org_desc')}}</textarea>

                                    @error('org_desc')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">General Properties</h6>
                            </div>
                            <div class="card-body mb-3">
                                <div class="mb-3">
                                    <label for="celularity_id" class="form-label">Celularity</label>
                                    <select class="form-select select2" name="celularity_id" id="celularity_id" wire:model="celularity_id">
                                        <option value="">Celularity</option>
                                        @foreach ($celularities as $celularity )
                                        <option value="{{$celularity->id}}" @if (old('celularity_id')==$celularity->id) selected @endif>{{$celularity->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('celularity_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="reproduction_id" class="form-label">Reproduction</label>
                                    <select class="form-select select2" name="reproduction_id" id="reproduction_id" wire:model="reproduction_id">
                                        <option value="">Reproduction</option>
                                        @foreach ($reproductions as $reproduction )
                                        <option value="{{$reproduction->id}}" @if (old('reproduction_id')==$reproduction->id) selected @endif>{{$reproduction->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('reproduction_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ploidy_id" class="form-label">Ploidy</label>
                                    <select class="form-select select2" name="ploidy_id" id="ploidy_id" wire:model="ploidy_id">
                                        <option value="">Ploidy</option>
                                        @foreach ($ploidies as $ploidy )
                                        <option value="{{$ploidy->id}}" @if (old('ploidy_id')==$ploidy->id) selected @endif>{{$ploidy->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($ploidy_id==3)
                                    <label for="plodesc" class="form-label">Polyploid description</label>
                                    <input type="text" class="form-control @error('plodesc') is-invalid @enderror" wire:model="plodesc" id="plodesc" name="plodesc" value="{{old('plodesc')}}">
                                    @error('plodesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @if ($ploidy_id==4)
                                    <label for="plodesc" class="form-label">Allopolyploid description</label>
                                    <input type="text" class="form-control @error('plodesc') is-invalid @enderror" wire:model="plodesc" id="plodesc" name="plodesc" value="{{old('plodesc')}}">
                                    @error('plodesc')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    @endif

                                    @error('ploidy_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="row g-3">
                                        <label for="haploid_size" class="form-label">Haploid Genome Size</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('haploid_size') is-invalid @enderror" wire:model="haploid_size" id="haploid_size" name="haploid_size" value="{{old('haploid_size')}}">
                                            @error('haploid_size')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select select2" name="genome_size_id" id="genome_size_id" wire:model="genome_size_id">
                                                <option value="">Genome Sizes</option>
                                                @foreach ($genome_sizes as $genome_size )
                                                <option value="{{$genome_size->id}}" @if (old('genome_size_id')==$genome_size->id) selected @endif>{{$genome_size->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('genome_size_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Organism Replicons</h6>
                            </div>
                            <div class="card-body mb-3">
                                <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Size (Units)</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($repls as $index => $repl)
                                        <tr>
                                            <td>
                                                <input type="text" name="repls[{{$index}}][repl_name]" class="form-control" value="{{$repl['repl_name']}}" wire:model="repls.{{$index}}.repl_name">
                                                @error('repls.*.repl_name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <select class="form-select select2" name="repls[{{$index}}][repl_type_id]" wire:model="repls.{{$index}}.repl_type_id">
                                                    <option value="0">Replicon Type</option>
                                                    @foreach ($repl_types as $repl_type )
                                                    <option value="{{$repl_type->id}}">{{$repl_type->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('repls.*.repl_type_id')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <select class="form-select select2" name="repls[{{$index}}][repl_loc_id]" wire:model="repls.{{$index}}.repl_loc_id">
                                                    <option value="0">Replicon Location</option>
                                                    @foreach ($repl_locs as $repl_loc )
                                                    <option value="{{$repl_loc->id}}">{{$repl_loc->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('repls.*.repl_loc_id')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="text" name="repls[{{$index}}][repl_size]" class="form-control" value="{{$repl['repl_size']}}" wire:model="repls.{{$index}}.repl_size">
                                                        @error('repls.*.repl_size')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-select select2" name="repls[{{$index}}][genome_size2_id]" id="genome_size2_id" wire:model="repls.{{$index}}.genome_size2_id">
                                                            <option value="">Genome Sizes</option>
                                                            @foreach ($genome_sizes2 as $genome_size )
                                                            <option value="{{$genome_size->id}}" @if (old('genome2_size_id')==$genome_size->id) selected @endif>{{$genome_size->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger delete_row" wire:click.prevent="removeRepl({{$index}})">remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addRepl">+ Add Another Replicon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Phenotypes</h6>
                            </div>
                            <div class="card-body mb-3">
                                <div class="mb-3">
                                    <label for="disease" class="form-label">Disease</label>
                                    <input type="text" class="form-control @error('disease') is-invalid @enderror" wire:model="disease" id="disease" name="disease" value="{{old('disease')}}">
                                    @error('disease')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bio_rel_id" class="form-label">Biotic Relationship</label>
                                    <select class="form-select select2" name="bio_rel_id" id="bio_rel_id" wire:model="bio_rel_id">
                                        <option value="">Biotic Relationship</option>
                                        @foreach ($bio_rels as $bio_rel )
                                        <option value="{{$bio_rel->id}}" @if (old('bio_rel_id')==$bio_rel->id) selected @endif>{{$bio_rel->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('bio_rel_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="trop_level_id" class="form-label">Trophic Level</label>
                                    <select class="form-select select2" name="trop_level_id" id="trop_level_id" wire:model="trop_level_id">
                                        <option value="">Trophic Level</option>
                                        @foreach ($trop_levels as $trop_level )
                                        <option value="{{$trop_level->id}}" @if (old('trop_level_id')==$trop_level->id) selected @endif>{{$trop_level->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('trop_level_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Prokaryote morphology</h6>
                            </div>
                            <div class="card-body mb-3">
                                <div class="mb-3">
                                    <label for="trop_level_id" class="form-label">Shape</label>
                                    @foreach ($shapes->chunk(6) as $row)
                                    <div class="row">
                                        @foreach ( $row as $shape)
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="shape_id[]" wire:model="shape_id.{{ $shape->id }}" value="{{$shape->id}}" @if(is_array(old('shape_id')) && in_array($shape->id, old('shape_id'))) checked @endif>
                                                <label class="form-check-label">{{$shape->name}}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>

                                <div class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-md-1">
                                            <label for="gram" class="form-label">Gram</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select" name="gram" id="gram" wire:model="gram">
                                                <option value="">Select</option>
                                                <option value="1" @if (old('gram')==1) selected @endif>Positive</option>
                                                <option value="0" @if (old('gram')==0) selected @endif>Negative</option>
                                            </select>
                                        </div>
                                        @error('gram')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="col-md-1">
                                            <label for="motility" class="form-label">Motility</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select" name="motility" id="motility" wire:model="motility">
                                                <option value="">Select</option>
                                                <option value="1" @if (old('motility')==1) selected @endif>Yes</option>
                                                <option value="0" @if (old('motility')==0) selected @endif>No</option>
                                            </select>
                                        </div>
                                        @error('motility')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="col-md-1">
                                            <label for="enveloped" class="form-label">Enveloped</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select" name="enveloped" id="enveloped" wire:model="enveloped">
                                                <option value="">Select</option>
                                                <option value="1" @if (old('enveloped')==1) selected @endif>Yes</option>
                                                <option value="0" @if (old('enveloped')==0) selected @endif>No</option>
                                            </select>
                                        </div>
                                        @error('enveloped')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <div class="col-md-1">
                                            <label for="endospores" class="form-label">Endospores</label>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select" name="endospores" id="endospores" wire:model="endospores">
                                                <option value="">Select</option>
                                                <option value="1" @if (old('endospores')==1) selected @endif>Yes</option>
                                                <option value="0" @if (old('endospores')==0) selected @endif>No</option>
                                            </select>
                                        </div>
                                        @error('endospores')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Ecological environment</h6>
                            </div>
                            <div class="card-body mb-3">
                                <div class="mb-3">
                                    <label for="habitat_id" class="form-label">Habitat</label>
                                    <select class="form-select select2" name="habitat_id" id="habitat_id" wire:model="habitat_id">
                                        <option value="">--Habitat--</option>
                                        @foreach ($habitats as $habitat )
                                        <option value="{{$habitat->id}}" @if (old('habitat_id')==$habitat->id) selected @endif>{{$habitat->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('habitat_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="salinity_id" class="form-label">Salinity</label>
                                    <select class="form-select select2" name="salinity_id" id="salinity_id" wire:model="salinity_id">
                                        <option value="">--Salinity--</option>
                                        @foreach ($salinities as $salinity )
                                        <option value="{{$salinity->id}}" @if (old('salinity_id')==$salinity->id) selected @endif>{{$salinity->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('salinity_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="oxygen_id" class="form-label">Oxygen Requirement</label>
                                    <select class="form-select select2" name="oxygen_id" id="oxygen_id" wire:model="oxygen_id">
                                        <option value="">--Oxygen Requirement--</option>
                                        @foreach ($oxygens as $oxygen )
                                        <option value="{{$oxygen->id}}" @if (old('oxygen_id')==$oxygen->id) selected @endif>{{$oxygen->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('oxygen_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="temp_range_id" class="form-label">Temperature Range</label>
                                    <select class="form-select select2" name="temp_range_id" id="temp_range_id" wire:model="temp_range_id">
                                        <option value="">--Temperature Range--</option>
                                        @foreach ($temp_ranges as $temp_range )
                                        <option value="{{$temp_range->id}}" @if (old('temp_range_id')==$temp_range->id) selected @endif>{{$temp_range->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('temp_range_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="optimum_temp" class="form-label">Optimum Temperature</label>
                                    <div class="row g-2">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control @error('optimum_temp') is-invalid @enderror" wire:model="optimum_temp" id="optimum_temp" name="optimum_temp" value="{{old('optimum_temp')}}">
                                        </div>
                                        <div class="col-md-1">
                                            <label for="">Celcius</label>
                                        </div>
                                    </div>
                                    @error('optimum_temp')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(3)">Back</button>
                        <button class="btn btn-primary pull-right" type="button" wire:click="fourthStepSubmit">Next</button>

                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
                    <div class="col-md-12">
                        <div class="card card-outline card-info collapsed-card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Publications</h6>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body mb-3">
                                <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
                                    <thead>
                                        <tr>
                                            <th scope="col">DOI / Pubmed</th>
                                            <th scope="col">Publication ID</th>
                                            <th scope="col">Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publications as $index => $publication)
                                        <tr>
                                            <td>
                                                <select class="form-select select2" name="publications[{{$index}}][pub_identifier_id]" wire:model="publications.{{$index}}.pub_identifier_id">
                                                    <option value="">PubMed / DOI</option>
                                                    @foreach ($pub_identifiers as $pub_identifier )
                                                    <option value="{{$pub_identifier->id}}">{{$pub_identifier->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('publications.*.pub_identifier_id')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="publication[{{$index}}][pub_id]" class="form-control" value="{{$publication['pub_id']}}" wire:model="publications.{{$index}}.pub_id">
                                                @error('publications.*.pub_id')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="publication[{{$index}}][article_title]" class="form-control" value="{{$publication['article_title']}}" wire:model="publications.{{$index}}.article_title">
                                                @error('publications.*.article_title')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-danger delete_row" wire:click.prevent="removePublication({{$index}})">remove</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-secondary" wire:click.prevent="addPublication">+ Add Another Publication</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Back</button>
                        <button class="btn btn-primary pull-right" type="button" wire:click="fifthStepSubmit">Next</button>
                    </div>
                </div>
                <div class="row setup-content {{ $currentStep != 6 ? 'display-none' : '' }}" id="step-6">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Cannot submit yet.</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3>Project Description</h3>
                        <table class="table">
                            <tr>
                                <td class="col-md-3">Project Title</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->title }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Title</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->description }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Relevance</td>
                                <td class="col-md-1">:</td>
                                @if ($this->relevance_id == 7)
                                    <td class="align-left">{{ $this->relevanceName($this->relevance_id) }},  {{ $this->reldesc }}</td>    
                                @else
                                    <td class="align-left">{{ $this->relevanceName($this->relevance_id) }}</td>
                                @endif
                                
                            </tr>
                        </table>
                        <table class="table">
                            <h3>Umbrella Project</h3>
                            <tr>
                                <td class="col-md-3">Project Accession</td>
                                <td class="col-md-1">:</td>
                                <td class="align-right">{{ $this->bioprojectName($this->umbproject_id) }}</td>
                            </tr>
                        </table>
                        
                        <table class="table">
                            <h3>External Links Project</h3>
                            @forelse ( $this->externallinks as $item => $value )
                            <tr>
                                <td class="col-md-3">Link Description</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->externallinks[$item]['link_description'] }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Link URL</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->externallinks[$item]['link_url'] }}</td>
                            </tr>
                            @empty
                                <td class="col-md-12">There is no External Links data</td> 
                            @endforelse
                        </table>

                        <table class="table">
                            <h3>Grants Project</h3>
                            @forelse ( $this->grants as $item => $value )
                                <tr>
                                    <td class="col-md-3">Fund Agency Description</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->fundagencyName($this->grants[$item]['fundagency_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Grant Title</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->grants[$item]['grant_title'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Grant Program</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->grants[$item]['grant_program'] }}</td>
                                </tr>
                            @empty
                                <td class="col-md-12">There is no Grants data</td>   
                            @endforelse
                        </table>

                        <table class="table">
                            <h3>Consortium</h3>
                            <tr>
                                <td class="col-md-3">Consortium Name</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->consortiumName($this->consortium_id) }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <h3>Project Data Type</h3>
                            @if ($this->data_type_id > 0)
                                @foreach ( $this->data_type_id as $item => $value )
                                <tr>
                                @if ($item == 10)
                                    <td class="align-left">{{ $this->dataTypeName($item) }} , {{ $this->datatypedesc }}</td>    
                                @else
                                    <td class="align-left">{{ $this->dataTypeName($item) }}</td>
                                @endif 
                                </tr>  
                                @endforeach
                            @endif
                        </table>

                        <table class="table">
                            <h3>Sample Data</h3>
                            <tr>
                                <td class="col-md-3">Sample Scope</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->sampleScopeName($this->samplescope_id) }} {{ $this->samplescopedesc == 7 ? '('.$this->samplescopedesc.')' : ''}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Sample Material</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->sampleMaterialName($this->material_id) }} {{ $this->matdesc == 7 ? '('.$this->matdesc.')' : ''}}</td>
                            </tr>
                            <tr>    
                                <td class="col-md-3">Sample Capture</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->sampleCaptureName($this->capture_id) }} {{ $this->capdesc == 7 ? '('.$this->capdesc.')' : ''}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Sample Methodology</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->sampleMethodologyName($this->methodology_id) }} {{ $this->metdesc == 7 ? '('.$this->metdesc.')' : ''}}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <h3>Objectives</h3>
                            @if ($this->objective_id > 0)
                                @foreach ( $this->objective_id as $item => $value )
                                <tr>
                                @if ($item == 11)
                                    <td class="align-left">{{ $this->objectiveName($item) }} , {{ $this->objdesc }}</td>    
                                @else
                                    <td class="align-left">{{ $this->objectiveName($item) }}</td>
                                @endif 
                                </tr>  
                                @endforeach
                            @else
                                <td class="col-md-12">There is no Objectives data</td> 
                            @endif
                        </table>

                        <table class="table">
                            <h3>Organism Information</h3>
                            <tr>
                                <td class="col-md-3">Organism</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->organismName($this->organism_id) }}</td>
                            </tr>
                            
                            <tr>
                                <td class="col-md-3">Novel Organism</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">
                                    @if ($this->novel_org)
                                        {{ $this->novel_desc }}
                                    @else
                                        None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Strain, Breed, Cultivar</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->sbc }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Isolate</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->isolate }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Organism Description</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->org_desc }}</td>
                            </tr>
                        </table>
                        <table class="table">
                            <h3>General Properties</h3>
                            <tr>
                                <td class="col-md-3">Celularity</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->celularityName($this->celularity_id) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Reproduction</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->reproductionName($this->reproduction_id) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Ploidy</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{ $this->ploidyName($this->ploidy_id) }}, {{ $this->plodesc }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Haploid Size</td>
                                <td class="col-md-1">:</td>
                                <td class="align-left">{{$this->haploid_size }} {{ $this->genomeSizeName($this->genome_size_id) }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <h3>Organism Replicons</h3>
                            @forelse ( $this->repls as $item => $value )
                                <tr>
                                    <td class="col-md-3">Name</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->repls[$item]['repl_name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Type</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->replTypeName($this->repls[$item]['repl_type_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Location</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->replLocationName($this->repls[$item]['repl_loc_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Size</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->repls[$item]['repl_size'] }} {{$this->genomeSizeName($this->repls[$item]['genome_size2_id']) }}</td>
                                </tr>
                            @empty
                                <td class="col-md-12">There is no Organism Replicons data</td>   
                            @endforelse
                        </table>

                        <table class="table">
                            <h3>Phenotypes</h3>
                            <tr>
                                <td class="col-md-3">Disease</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->disease }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Biotic Relationship</td>
                                <td class="col-md-1">:</td>
                                <td> {{ $this->bioticRelName($this->bio_rel_id) }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Trophic Level</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->trophicLevelName($this->trop_level_id) }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <h3>Prokaryote morphology</h3>
                            <tr>
                                <td class="col-md-3">Gram</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->gram > 0 ? "Positive" : "Negative" }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Motility</td>
                                <td class="col-md-1">:</td>
                                <td> {{ $this->motility > 0 ? "Yes" : "No" }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Enveloped</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->enveloped  > 0 ? "Yes" : "No" }}</td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Endospores</td>
                                <td class="col-md-1">:</td>
                                <td>{{ $this->endospores  > 0 ? "Yes" : "No" }}</td>
                            </tr>
                        </table>

                        <table class="table">
                            <h3>Publication</h3>
                            @forelse ( $this->publications as $item => $value )
                                <tr>
                                    <td class="col-md-3">DOI/Pubmed</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->pubIdentifierName($this->publications[$item]['pub_identifier_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Publication ID</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->publications[$item]['pub_id'] }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-3">Article Title</td>
                                    <td class="col-md-1">:</td>
                                    <td>{{ $this->publications[$item]['article_title'] }}</td>
                                </tr>
                            @empty
                                <td class="col-md-12">There is no publications data</td>   
                            @endforelse
                        </table>

                        <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(5)">Back</button>
                        <button class="btn btn-success pull-right" wire:click="submitForm" wire:loading.attr="disabled" wire:target="submitForm" type="button">
                            <span wire:loading.remove wire:target="submitForm">Finish!</span>
                            <span wire:loading wire:target="submitForm">Submitting...</span>
                        </button>
                    </div>
                </div>


                    <!-- <button type="submit" class="btn btn-primary">Create Bioproject</button> -->
            </div>
        </div>

        </form>
    </div>
</div>





@push('js')
    <script>
        document.addEventListener('livewire:load', function () {
            const steps = document.querySelectorAll('#nav-steps .nav-item').length;
            document.getElementById('wizard-progress').style.width = 100 / steps * @this.currentStep +"%"
        })
        document.addEventListener('livewire:update', function () {
            $('.form-select.select2').each(function(){
                $(this).select2({
                    theme: 'bootstrap-5',
                    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                    placeholder: 'Select an option'
                })
                $(this).on('change', function (e) {
                    @this.set($(this).attr("wire:model"), $(this).select2("val"));
                });
            });
            const steps = document.querySelectorAll('#nav-steps .nav-item').length;
            document.getElementById('wizard-progress').style.width = 100 / steps * @this.currentStep +"%";

            const data_type_id = document.getElementsByName('data_type_id[]')
            let data_type_id_true = Object.assign({}, @this.get('data_type_id'))
            data_type_id.forEach(element => {
                element.addEventListener('change', (event) => {
                    if (event.currentTarget.checked) {
                        let val = {
                            [event.currentTarget.value]: event.currentTarget.value
                        }
                        data_type_id_true = {
                            ...data_type_id_true,
                            ...val
                        };
                    } else {
                        delete data_type_id_true[event.currentTarget.value]
                    }
                    @this.set('data_type_id', data_type_id_true)
                })
            });
        })

    // listen for ajax-alert events dispatched by Livewire methods
    document.addEventListener('ajax-alert', function(e) {
        const detail = e.detail || {};
        const message = detail.message || detail.msg || 'Notification';
        const type = detail.type || 'info';
        try {
            if (typeof showAjaxAlert === 'function') {
                showAjaxAlert(message, type);
            } else {
                alert(message);
            }
        } catch (err) {
            console.debug('ajax-alert handler error', err);
            try { alert(message); } catch (e) {}
        }
    })

    // Simple confirmation then call Livewire discard for bioproject draft
    function confirmDiscardBioprojectDraft() {
        if (!confirm('Discard draft? This action cannot be undone.')) return;
        try { @this.call('discardDraft'); } catch (e) { console.debug('Livewire discard call failed', e); }
    }

    // reload page when a draft was discarded server-side
    document.addEventListener('draft-discarded', function() {
        setTimeout(() => { window.location.reload(); }, 250);
    })
    </script>
@endpush