{{-- <form>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model.lazy="title" id="title" name="title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="umbrella" class="form-label">Umbrella Project</label>
        <select class="form-select" name="umbproject_id" wire:model="selectedUmbrella" id="umbproject_id">
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
        <select class="form-select" name="organism_id" id="organism_id" wire:model="selectedOrganism">
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
        <input type="text" class="form-control @error('relevance') is-invalid @enderror" id="relevance" wire:model="relevance" name="relevance" value="{{old('relevance')}}">
        @error('relevance')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" wire:model="description" rows="3">{{old('description')}}</textarea>

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
                    <input class="form-check-input" type="checkbox" name="data_type_id[]" wire:model="selectedDatatypes" value="{{$datatype->id}}" @if(is_array(old('data_type_id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
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
                    <input class="form-check-input" type="radio" name="samplescope_id" wire:model="selectedSampleScope" value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id)) checked @endif>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grants as $index => $grant)
                    <tr>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            {{$grant['fundagency']['name']}}
                            @else
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            {{$grant['grant_program']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][program]" class="form-control" value="{{$grant['grant_program']}}" wire:model="grants.{{$index}}.grant_program">
                            @error('newGrants.*.grant_program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>@if ($editedGrantIndex !== $index)
                            {{$grant['grant_title']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                            @error('newGrants.*.grant_title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            <button class="btn btn-sm btn-primary" wire:click.prevent="editGrant({{$index}})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click.prevent="deleteGrant({{$index}})">Delete</button>
                            @else
                            <button class="btn btn-sm btn-warning" wire:click.prevent="saveGrant({{$index}})">Save</button>
                            @endif
                        </td>
                        <!-- <td>{{$grant['grant_program']}}</td> -->
                        <!-- <td>{{$grant['grant_title']}}</td> -->
                    </tr>
                    @endforeach
                    @foreach ($newGrants as $index => $newGrant )
                    <tr>

                        {{$newGrants[0]['grant_title']}}
                        <td>
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="newGrants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_program]" class="form-control" value="{{$newGrant['grant_program']}}" wire:model="newGrants.{{$index}}.grant_program">
                            @error('newGrants.*.program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_title]" class="form-control" value="{{$newGrant['grant_title']}}" wire:model="newGrants.{{$index}}.grant_title">
                            @error('newGrants.*.title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger delete_row" wire:click.prevent="removeGrant({{$index}})">remove</button>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-secondary" wire:click.prevent="newGrant">+ Add Another Grant</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


    <button wire:click.prevent="update()" class="btn btn-primary">Update Bioproject</button>
</form> --}}
<form wire:submit.prevent="submitForm">
    <div>
        @if(!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
        @endif
        <ul id="nav-steps" class="nav nav-pills mb-2 nav-justified">
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
                        <input type="text" class="form-control @error('submitter_lab') is-invalid @enderror" wire:model="submitter_lab" id="submitter_lab" name="submitter_lab" value="{{old('submitter_lab')}}" disabled>
                        @error('submitter_lab')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="center" class="form-label">Center <font color="red">*</font></label>
                        <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center" id="submitter_center" name="submitter_center" value="{{old('submitter_center')}}" disabled>
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
                        {{-- {{ $selected_hold_release }} --}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="selected_hold_release" wire:model="selected_hold_release" value=@if (isset($selected_hold_release)) "1" @endif>
                            <label class="form-check-label">Hold (not viewable until the release of linked data)</label>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="selected_hold_release" wire:model="selected_hold_release" value=@if (!isset($selected_hold_release)) "1" @endif>
                            <label class="form-check-label">Release immediately (After the approval is passed, release immediately following curation) </label>
                        </div>
                        <!-- </div> -->
                        @error('selected_hold_release')
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
                        <select class="form-select select2" name="relevance_id" id="relevance_id" wire:model="selectedRelevance">
                            <option value="">Relevance</option>
                            @foreach ($relevances as $relevance )
                            <option value="{{$relevance->id}}" @if (old('relevance_id')==$selectedRelevance) selected @endif>{{$relevance->name}}</option>
                            @endforeach
                        </select>
                        @if ($selectedRelevance==7)
                        <label for="relevanceDescription" class="form-label">Relevance Description <font color="red">*</font></label>
                        <input type="text" class="form-control @error('relevanceDescription') is-invalid @enderror" wire:model="relevanceDescription" id="relevanceDescription" name="relevanceDescription" value="{{old('relevanceDescription')}}">
                        @error('relevanceDescription')
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
                            <select class="form-select" name="umbproject_id" wire:model="selectedUmbrella" id="umbproject_id">
                                <option value="">Umbrella Project</option>
                                @foreach ($umbrellas as $umbrella )
                                <option value="{{$umbrella->id}}" @if (old('umbproject_id')==$umbrella->id) selected @endif>{{$umbrella->title}}</option>
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
                            @if ($editedGrantIndex !== $index)
                            {{$grant['fundagency']['name']}}
                            @else
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            {{$grant['grant_program']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][program]" class="form-control" value="{{$grant['grant_program']}}" wire:model="grants.{{$index}}.grant_program">
                            @error('newGrants.*.grant_program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>@if ($editedGrantIndex !== $index)
                            {{$grant['grant_title']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                            @error('newGrants.*.grant_title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            <button class="btn btn-sm btn-primary" wire:click.prevent="editGrant({{$index}})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click.prevent="deleteGrant({{$index}})">Delete</button>
                            @else
                            <button class="btn btn-sm btn-warning" wire:click.prevent="saveGrant({{$index}})">Save</button>
                            @endif
                        </td>
                        <!-- <td>{{$grant['grant_program']}}</td> -->
                        <!-- <td>{{$grant['grant_title']}}</td> -->
                    </tr>
                    @endforeach
                    @foreach ($newGrants as $index => $newGrant )
                    <tr>

                        {{$newGrants[0]['grant_title']}}
                        <td>
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="newGrants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_program]" class="form-control" value="{{$newGrant['grant_program']}}" wire:model="newGrants.{{$index}}.grant_program">
                            @error('newGrants.*.program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_title]" class="form-control" value="{{$newGrant['grant_title']}}" wire:model="newGrants.{{$index}}.grant_title">
                            @error('newGrants.*.title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger delete_row" wire:click.prevent="removeGrant({{$index}})">remove</button>
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
                        <label for="consortium_id" class="form-label">Consortium <font color="red">*</font></label>
                        <select class="form-select" name="consortium_id" id="consortium_id" wire:model="selectedConsortium">
                            <option value="">Consortium</option>
                            @foreach ($consortia as $consortium )
                            <option value="{{$consortium->id}}" @if (old('selectedConsortium')==$consortium->id) selected @endif>{{$consortium->name}}</option>
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
                                <input class="form-check-input" type="checkbox" name="data_type_id[]" wire:model="data_type_id.{{ $datatype->id }}" value="{{$datatype->id}}" @if(is_array(old('data_type_id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
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
                        <select class="form-select" name="samplescope_id" id="samplescope_id" wire:model="samplescope_id">
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
                        <select class="form-select" name="material_id" id="material_id" wire:model="material_id">
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
                        <select class="form-select" name="capture_id" id="capture_id" wire:model="capture_id">
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
                        <select class="form-select" name="methodology_id" id="methodology_id" wire:model="methodology_id">
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
                                <input class="form-check-input" type="checkbox" name="objective_id[]" wire:model="selectedObjective" value="{{$objective->id}}" @if(is_array(old('objective_id')) && in_array($objective->id, old('objective_id'))) checked @endif>
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
            <button class="btn btn-primary pull-right" type="button" wire:click="secondStepSubmit">Next</button>
        </div>
    </div>
    <!-- <button type="submit" class="btn btn-primary">Create Bioproject</button> -->
</form>
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
    </script>
@endpush