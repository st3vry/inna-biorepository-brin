<form wire:submit.prevent="submitForm">
    <div>
        @if(!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
        @endif
        <div class="stepwizard mb-3">
            <div class="stepwizard-row setup-panel">
                <div class="multi-wizard-step">
                    <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                    <p>Submitter</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                    <p>General Info</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">3</a>
                    <p>Project Type</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-4" type="button" class="btn {{ $currentStep != 4? 'btn-default' : 'btn-primary' }}">4</a>
                    <p>Target</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-5" type="button" class="btn {{ $currentStep != 5 ? 'btn-default' : 'btn-primary' }}">5</a>
                    <p>Publication</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-6" type="button" class="btn {{ $currentStep != 6 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">6</a>
                    <p>Preview</p>
                </div>
            </div>
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('submitter_name') is-invalid @enderror" wire:model="submitter_name" id="submitter_name" name="submitter_name" value="{{old('submitter_name')}}" disabled>
                        @error('submitter_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('submitter_email') is-invalid @enderror" wire:model="submitter_email" id="submitter_email" name="submitter_email" value="{{old('submitter_email')}}" disabled>
                        @error('submitter_email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lab" class="form-label">Lab</label>
                        <input type="text" class="form-control @error('submitter_lab') is-invalid @enderror" wire:model="submitter_lab" id="submitter_lab" name="submitter_lab" value="{{old('submitter_lab')}}" disabled>
                        @error('submitter_lab')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
    <div>
        @if(!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
        @endif
        <div class="stepwizard mb-3">
            <div class="stepwizard-row setup-panel">
                <div class="multi-wizard-step">
                    <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                    <p>Submitter</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                    <p>General Info</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">3</a>
                    <p>Project Type</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-4" type="button" class="btn {{ $currentStep != 4? 'btn-default' : 'btn-primary' }}">4</a>
                    <p>Target</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-5" type="button" class="btn {{ $currentStep != 5 ? 'btn-default' : 'btn-primary' }}">5</a>
                    <p>Publication</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-6" type="button" class="btn {{ $currentStep != 6 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">6</a>
                    <p>Preview</p>
                </div>
            </div>
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('submitter_name') is-invalid @enderror" wire:model="submitter_name" id="submitter_name" name="submitter_name" value="{{old('submitter_name')}}" disabled>
                        @error('submitter_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('submitter_email') is-invalid @enderror" wire:model="submitter_email" id="submitter_email" name="submitter_email" value="{{old('submitter_email')}}" disabled>
                        @error('submitter_email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lab" class="form-label">Lab</label>
                        <input type="text" class="form-control @error('submitter_lab') is-invalid @enderror" wire:model="submitter_lab" id="submitter_lab" name="submitter_lab" value="{{old('submitter_lab')}}" disabled>
                        @error('submitter_lab')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="center" class="form-label">Center</label>
                        <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center" id="submitter_center" name="submitter_center" value="{{old('submitter_center')}}" disabled>
                        @error('submitter_center')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Data Release</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="hold_release" class="form-label">-</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="true" @if (old('hold_release')==true) ) checked @endif>
                                    <label class="form-check-label">Hold Release</label>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="false" @if (old('hold_release')==false) ) checked @endif>
                                    <label class="form-check-label">Release immediately</label>
                                </div>
                            </div>

                        </div>
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
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" id="title" name="title" value="{{old('title')}}">
                        @error('title')
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
                        <label for="relevance" class="form-label">Relevance</label>
                        <select class="form-select" name="relevance_id" id="relevance_id" wire:model="relevance_id">
                            <option value="">Relevance</option>
                            @foreach ($relevances as $relevance )
                            <option value="{{$relevance->id}}" @if (old('relevance_id')==$relevance->id) selected @endif>{{$relevance->name}}</option>
                            @endforeach
                        </select>
                        @if ($relevance_id==7)
                        <label for="reldesc" class="form-label">Relevance Description</label>
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
                        <select class="form-select" name="umbproject_id" wire:model="umbproject_id" id="umbproject_id">
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
                <div class="card-body"></div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Grants</h5>
                </div>
                <div class="card-body">
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
                                            <select class="form-select" name="grants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
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
                                            @error('grants.*.program')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="grant[{{$index}}][grant_title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                                            @error('grants.*.title')
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
                        </div>
                        <!-- /.card-body -->
                    </div>
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
                        <select class="form-select" name="consortium_id" id="consortium_id" wire:model="consortium_id">
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
            <h3> Project Type</h3>
            <div class="mb-3">
                <label class="mb-3">Data Type</label>
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

                @error('data_type_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

                    <div class="mb-3">
                        <label for="center" class="form-label">Center</label>
                        <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center" id="submitter_center" name="submitter_center" value="{{old('submitter_center')}}" disabled>
                        @error('submitter_center')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Data Release</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="hold_release" class="form-label">-</label>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="true" @if (old('hold_release')==true) ) checked @endif>
                                    <label class="form-check-label">Hold Release</label>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="false" @if (old('hold_release')==false) ) checked @endif>
                                    <label class="form-check-label">Release immediately</label>
                                </div>
                            </div>

                        </div>
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
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" id="title" name="title" value="{{old('title')}}">
                        @error('title')
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
                        <label for="relevance" class="form-label">Relevance</label>
                        <select class="form-select" name="relevance_id" id="relevance_id" wire:model="relevance_id">
                            <option value="">Relevance</option>
                            @foreach ($relevances as $relevance )
                            <option value="{{$relevance->id}}" @if (old('relevance_id')==$relevance->id) selected @endif>{{$relevance->name}}</option>
                            @endforeach
                        </select>
                        @if ($relevance_id==7)
                        <label for="reldesc" class="form-label">Relevance Description</label>
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
                        <select class="form-select" name="umbproject_id" wire:model="umbproject_id" id="umbproject_id">
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
                                            @error('grants.*.program')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="externallinks[{{$index}}][link_url]" class="form-control" value="{{$externallink['link_url']}}" wire:model="externallinks.{{$index}}.link_url">
                                            @error('grants.*.title')
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
                                            <select class="form-select" name="grants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
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
                                            @error('grants.*.program')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="grant[{{$index}}][grant_title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                                            @error('grants.*.title')
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
                        </div>
                        <!-- /.card-body -->
                    </div>
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
                        <select class="form-select" name="consortium_id" id="consortium_id" wire:model="consortium_id">
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
            <h3> Project Type</h3>
            <div class="mb-3">
                <label class="mb-3">Data Type</label>
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

            <div class="mb-3">
                <label for="material" class="form-label">Material</label>
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
            <div class="mb-3">
                <label class="mb-3">Sample Scope</label>
                @foreach ($samplescopes->chunk(6) as $row)
                <div class="row">
                    @foreach ( $row as $samplescope)
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="samplescope_id" wire:model="samplescope_id" value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id)
                            ) checked @endif>
                            <label class="form-check-label">{{$samplescope->name}}</label>
                        </div>
                    </div>

                    @endforeach
                </div>
                @endforeach
                @if ($samplescope_id==7)
                <label for="samplescopedesc" class="form-label">Other sample scope description</label>
                <input type="text" class="form-control @error('samplescopedesc') is-invalid @enderror" wire:model="samplescopedesc" id="samplescopedesc" name="samplescopedesc" value="{{old('samplescopedesc')}}">
                @error('samplescopedesc')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @endif

                @error('samplescope_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-3">
                <label for="capture" class="form-label">Capture</label>
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

            <div class="mb-3">
                <label for="methodology" class="form-label">Methodology</label>
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

            <div class="mb-3">
                <label for="organism_id" class="form-label">Organism</label>
                <select class="form-select" name="organism_id" id="organism_id" wire:model="organism_id">
                    <option value="">Organism</option>
                    @foreach ($organisms as $organism )
                    <option value="{{$organism->id}}" @if (old('organism_id')==$organism->id) selected @endif>{{$organism->name}}</option>
                    @endforeach
                </select>

                @error('organism_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>


            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
        <div class="col-md-12">
            <h3> Target</h3>

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
                                    <select class="form-select" name="publications[{{$index}}][pub_identifier_id]" wire:model="publications.{{$index}}.pub_identifier_id">
                                        <option value="0">PubMed / DOI</option>
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
                                    @error('grants.*.article_title')
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
            <h3>Preview</h3>
            <table class="table">
                <tr>
                    <td>Title:</td>
                    <td><strong>{{$title}}</strong></td>
                </tr>
                <tr>
                    <td>Team Price:</td>

                </tr>
                <tr>
                    <td>Team status:</td>

                </tr>
                <tr>
                    <td>Team Detail:</td>

                </tr>
            </table>

            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(5)">Back</button>
            <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            <!-- /.card -->

            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="fifthStepSubmit">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 6 ? 'display-none' : '' }}" id="step-6">
        <div class="col-md-12">
            <h3>Preview</h3>
            <table class="table">
                <tr>
                    <td>Title:</td>
                    <td><strong>{{$title}}</strong></td>
                </tr>
                <tr>
                    <td>Team Price:</td>

                </tr>
                <tr>
                    <td>Team status:</td>

                </tr>
                <tr>
                    <td>Team Detail:</td>

                </tr>
            </table>

            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(5)">Back</button>
            <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
        </div>
    </div>


    <!-- <button type="submit" class="btn btn-primary">Create Bioproject</button> -->
</form>