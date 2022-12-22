<form wire:submit.prevent="submitForm">
    <div>
        @if(!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
        @endif
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="multi-wizard-step">
                    <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">Submitter Information</a>
                    <!--<p>Submitter Information</p>-->
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">General Information</a>
                    <!--<p>General Information</p>-->
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">Sample Information</a>
                    <!--<p>Sample Information</p>-->
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-4" type="button" class="btn {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">Preview</a>
                    <!--<p>Sample Information</p>-->
                </div>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
            <div class="col-md-12">
                <h3>Submitter Information</h3>
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
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Organization</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="center" class="form-label">Center</label>
                            <input type="text" class="form-control @error('submitter_center') is-invalid @enderror" wire:model="submitter_center" id="submitter_center" name="submitter_center" value="{{old('submitter_center')}}" disabled>
                            @error('submitter_center')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-primary nextBtn pull-right" wire:click="firstStepSubmit" type="button">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
            <div class="col-md-12">
            <h3>General Information</h3>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Release Date</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="true"  @if (old('hold_release')==true) ) checked @endif>
                                        <label class="form-check-label">Hold (not viewable until the release of linked data)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="false"  @if (old('hold_release')==false) ) checked @endif>
                                        <label class="form-check-label">After the approval is passed, release immediately following curation</label>
                                
                                    </div>
                                </div>
                            </div>
                            @error('hold_release')
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
                        <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
                            <thead>
                                <tr>
                                    <th scope="col">Link Description</th>
                                    <th scope="col">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biosample_links as $index => $biosample_link)
                                <tr>
                                    <td>
                                        <input type="text" name="biosample_link[{{$index}}][biosample_link_description]" class="form-control" value="{{$biosample_link['biosample_link_description']}}" wire:model="biosample_links.{{$index}}.biosample_link_description">
                                        @error('biosample_links.*.description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="biosample_link[{{$index}}][biosample_link_url]" class="form-control" value="{{$biosample_link['biosample_link_url']}}" wire:model="biosample_links.{{$index}}.biosample_link_url">
                                        @error('biosample_links.*.url')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete_row" wire:click.prevent="removeLink({{$index}})">remove</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-secondary" wire:click.prevent="addLink">+ Add Another Link</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Comments</h5>
                    </div>
                    <div class="card-body mb-3">
                        <label for="comments" class="form-label">Private comments to staff</label>
                        <input type="textarea" class="form-control" wire:model="comments" id="comments" name="comments" value="{{old('comments')}}">
                       
                    </div>
                </div>
                <button class="btn btn-danger nextBtn  pull-right" type="button" wire:click="back(1)">Back</button>
                <button class="btn btn-primary nextBtn  pull-right" type="button" wire:click="secondStepSubmit">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
            <div class="col-md-12">
                <h3>Sample Information</h3>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Sample Type</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="clinical" checked>
                                        <label class="form-check-label">Clinical or host-associated pathogen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="environmental">
                                        <label class="form-check-label">Environmental, food or other pathogen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="microbe">
                                        <label class="form-check-label">Microbe</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="model">
                                        <label class="form-check-label">Model organism or animal sample</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="human">
                                        <label class="form-check-label">Human</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="plant">
                                        <label class="form-check-label">Plant</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sample_type" wire:model="sample_type" value="Virus">
                                        <label class="form-check-label">Virus</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger nextBtn  pull-right" type="button" wire:click="back(2)">Back</button>
                <button class="btn btn-primary nextBtn  pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
            <div class="col-md-12">
                <h3>Preview</h3>
                <table class="table">
                    <tr>
                        <td>Team Name:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Team Price:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Team status:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Team Detail:</td>
                        <td></td>
                    </tr>
                </table>

                <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(3)">Back</button>
                <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            </div>
        </div>

    </div>

</form>