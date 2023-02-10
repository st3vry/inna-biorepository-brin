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
                <a href="#step-2" wire:click="back(2)" class="nav-link {{ $currentStep == 2 ? 'active' : ''  }} {{ $currentStep < 2 ? 'disabled' : '' }}">Bioproject</a>
            </li>
            <li class="nav-item">
                <a href="#step-3" wire:click="back(3)" class="nav-link {{ $currentStep == 3 ? 'active' : ''  }} {{ $currentStep < 3 ? 'disabled' : '' }}">Biosample</a>
            </li>
            <li class="nav-item">
                <a href="#step-4" wire:click="back(4)" class="nav-link {{ $currentStep == 4 ? 'active' : '' }} {{ $currentStep < 4 ? 'disabled' : '' }}">Experiment</a>
            </li>
            <li class="nav-item">
                <a href="#step-5" wire:click="back(5)" class="nav-link {{ $currentStep == 5 ? 'active' : '' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Run</a>
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
                                    <td></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bioproject Accession</th>
                                    <th scope="col">Bioproject Submission ID</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bioprojects as $bioproject )
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>{{$bioproject->accession}}</td>
                                    <td>{{$bioproject->submission_id}}</td>
                                    <td>{{$bioproject->title}}</td>
                                </tr>
                                @endforeach
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
                                    <td></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Biosample Accession</th>
                                    <th scope="col">Biosample Submission ID</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biosamples as $biosample )
                                <tr>
                                    <th scope="row"><input type="radio" name="bioproject_id"></th>
                                    <td>{{$biosample->accession}}</td>
                                    <td>{{$biosample->submission_id}}</td>
                                    <td>{{$biosample->title}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="secondStepSubmit">Next</button>
        </div>
    </div>
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
            document.getElementById('wizard-progress').style.width = 100 / steps * @this.currentStep +"%"
        })
    </script>
@endpush