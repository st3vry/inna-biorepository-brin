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
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" wire:model="search" class="form-control" placeholder="Search here">
                        </div>
                    </div>
                    <div class="overflow-scroll p-3 bg-light" style="width: 100%; height: 500px;">
                        <table class="m-auto table table-striped table-hover table-responsive ">
                            <thead style="position: sticky;top: 0" class="table-secondary">
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
                                    <th scope="row"><input type="radio" name="bioproject_id" wire:model="bioproject_id" value="{{$bioproject->id}}" @if (old('bioproject_id')==$bioproject->id) ) checked @endif></th>
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
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" wire:model="search" class="form-control" placeholder="Search here">
                        </div>
                    </div>
                    <div class="overflow-scroll p-3 bg-light" style="width: 100%; height: 500px;">
                        <table class="m-auto table table-striped table-hover table-responsive ">
                            <thead style="position: sticky;top: 0" class="table-secondary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Biosample Accession</th>
                                    <th scope="col">Biosample Submission ID</th>
                                    <th scope="col">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($biosamples as $biosample )
                                <tr title="{{$biosample->title}}">
                                    <th scope="row"><input type="checkbox" name="biosample_id[]" wire:model="biosample_id.{{ $biosample->id }}" value="{{$biosample->id}}" @if(is_array(old('biosample_id')) && in_array($biosample->id, old('biosample_id'))) checked @endif></th>
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
            <button class="btn btn-primary pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
        <div class="col-md-12">
            <!-- <h4>Bioproject</h4> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Experiment</h5>
                </div>
                <div class="card-body">
                    <div class="overflow-scroll p-3 bg-light" style="width:100%;max-width: 100%; height: 500px; overflow-x:scroll;">
                        <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                            <thead style="position: sticky;top: 0" class="table-secondary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Biosample Used</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Library Name</th>
                                    <th scope="col">Library Source</th>
                                    <th scope="col">Library Selection</th>
                                    <th scope="col">Library Strategy</th>
                                    <th scope="col">Library Construction Protocol</th>
                                    <th scope="col">Instrument</th>
                                    <th scope="col">Library Layout</th>
                                    <th scope="col">Insert Size</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($biosample_id as $id => $experiment)
                                <tr>
                                    <!-- {{$id}} -->
                                    <td>{{$no}}</td>
                                    <td><input type="text" name="experiment[{{$id}}][alias_exp]" wire:model="bioexperiment_id.{{$id}}.alias_exp"></td>
                                    <td>{{$this->biosampleSubmission($id)}} : {{$this->biosampleName($id)}}</td>
                                    <td><input type="text" name="experiment[{{$id}}][title]" wire:model="bioexperiment_id.{{$id}}.title"></td>
                                    <td><input type="text" name="experiment[{{$id}}][libname]" wire:model="bioexperiment_id.{{$id}}.libname"></td>
                                    <td>
                                        <select name="experiment[{{$id}}][libsource_id]" wire:model="bioexperiment_id.{{$id}}.libsource_id">
                                            <option value="">Select Lib Source</option>
                                            @foreach ( $libsources as $libsource )
                                            <option value="{{$libsource->id}}" @if (old('libsource_id')==$libsource->id) selected @endif>{{$libsource->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="experiment[{{$id}}][libselection_id]" wire:model="bioexperiment_id.{{$id}}.libselection_id">
                                            <option value="">Select Lib Selection</option>
                                            @foreach ( $libselections as $libselection )
                                            <option value="{{$libselection->id}}" @if (old('libselection_id')==$libselection->id) selected @endif>{{$libselection->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="experiment[{{$id}}][libstrategy_id]" wire:model="bioexperiment_id.{{$id}}.libstrategy_id">
                                            <option value="">Select Lib Strategy</option>
                                            @foreach ( $libstrategies as $libstrategy )
                                            <option value="{{$libstrategy->id}}" @if (old('libstrategy_id')==$libstrategy->id) selected @endif>{{$libstrategy->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="experiment[{{$id}}][libconsprot]" wire:model="bioexperiment_id.{{$id}}.libconsprot"></td>
                                    <td>
                                        <select name="experiment[{{$id}}][instrument_id]" wire:model="bioexperiment_id.{{$id}}.instrument_id">
                                            <option value="">Select Instrument</option>
                                            @foreach ( $instruments as $instrument )
                                            <option value="{{$instrument->id}}" @if (old('instrument_id')==$instrument->id) selected @endif>{{$instrument->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="experiment[{{$id}}][liblayout_id]" wire:model="bioexperiment_id.{{$id}}.liblayout_id">
                                            <option value="">Select Lib Layout</option>
                                            @foreach ( $liblayouts as $liblayout )
                                            <option value="{{$liblayout->id}}" @if (old('liblayout_id')==$liblayout->id) selected @endif>{{$liblayout->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="experiment[{{$id}}][inp_size]" wire:model="bioexperiment_id.{{$id}}.inp_size"></td>
                                    <td>
                                        <button class="btn btn-danger delete_row" wire:click.prevent="removeBiosample({{$id}})"><i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(3)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="fourthStepSubmit">Next</button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
        <div class="col-md-12">
            <!-- <h4>Bioproject</h4> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Run</h5>
                </div>
                <div class="card-body">
                    <div class="overflow-scroll p-3 bg-light" style="width:100%;max-width: 100%; height: 500px; overflow-x:scroll;">
                        <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                            <thead style="position: sticky;top: 0" class="table-secondary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Filename</th>
                                    <th scope="col">Run Contains File</th>
                                    <th scope="col">Filetype</th>
                                    <th scope="col">MD5 Checksum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>

                                @foreach ( $bioexperiment_id as $id => $run)

                                @if ($this->bioexperiment_id[$id]['liblayout_id'] == 2)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td><input type="text" name="alias_run"></td>
                                    <td><input type="text" name="file_name"></td>
                                    <td></td>
                                    <td>
                                        <select name="run[{{$id}}][filetype_id]" wire:model="biorun_id.{{$id}}.filetype_id">
                                            <option value="">Select Filetype</option>
                                            @foreach ( $filetypes as $filetype )
                                            <option value="{{$filetype->id}}" @if (old('filetype_id')==$filetype->id) selected @endif>{{$filetype->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="md5"></td>
                                    <?php $no++; ?>
                                </tr>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td><input type="text" name="alias_run"></td>
                                    <td><input type="text" name="file_name"></td>
                                    <td></td>
                                    <td>
                                        <select name="run[{{$id}}][filetype_id]" wire:model="biorun_id.{{$id}}.filetype_id">
                                            <option value="">Select Filetype</option>
                                            @foreach ( $filetypes as $filetype )
                                            <option value="{{$filetype->id}}" @if (old('filetype_id')==$filetype->id) selected @endif>{{$filetype->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="md5"></td>
                                    <?php $no++; ?>
                                </tr>
                                @else
                                <tr>
                                    <td>{{$no}}</td>
                                    <td><input type="text" name="alias_run"></td>
                                    <td><input type="text" name="file_name"></td>
                                    <td></td>
                                    <td>
                                        <select name="run[{{$id}}][filetype_id]" wire:model="biorun_id.{{$id}}.filetype_id">
                                            <option value="">Select Filetype</option>
                                            @foreach ( $filetypes as $filetype )
                                            <option value="{{$filetype->id}}" @if (old('filetype_id')==$filetype->id) selected @endif>{{$filetype->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="md5"></td>
                                    <?php $no++; ?>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Back</button>
            <button class="btn btn-primary pull-right" type="button" wire:click="fifthStepSubmit">Next</button>
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