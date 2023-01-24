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
                    <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">Submitter</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">Bioproject</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">Biosample</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-4" type="button" class="btn {{ $currentStep != 4? 'btn-default' : 'btn-primary' }}">Experiment</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-5" type="button" class="btn {{ $currentStep != 5 ? 'btn-default' : 'btn-primary' }}">Run</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-6" type="button" class="btn {{ $currentStep != 6 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">Preview</a>

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
            <!-- <h4>Bioproject</h4> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Bioproject Selection</h5>
                </div>
                <div class="card-body">
                    <div class="overflow-scroll p-3 bg-light" style="width: 100%; height: 500px;">
                        <table class="m-auto table table-striped table-hover table-responsive ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bioproject Accession</th>
                                    <th scope="col">Bioproject Submission ID</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(1)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="secondStepSubmit">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12">
            <!-- <h4>Bioproject</h4> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Biosample Selection</h5>
                </div>
                <div class="card-body">
                    <div class="overflow-scroll p-3 bg-light" style="width: 100%; height: 500px;">
                        <table class="m-auto table table-striped table-hover table-responsive ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Biosample Accession</th>
                                    <th scope="col">Biosample Submission ID</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                                <tr>
                                    <th scope="row"><input type="checkbox" name="biosample_id"></th>
                                    <td>Row 01 - Col 01</td>
                                    <td>Row 01 - Col 02</td>
                                    <td>Row 01 - Col 03</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(1)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="secondStepSubmit">Next</button>
        </div>
    </div>
</form>