<form wire:submit.prevent="submitForm">
    <div>
        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-outline-success me-2" wire:click="saveDraft" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Draft <i class="bi bi-save"></i></span>
                <span wire:loading>Saving...</span>
            </button>
            @if($draftId)
            {{-- <button type="button" class="btn btn-sm btn-outline-info me-2" wire:click="loadDraft({{ $draftId }})">Reload Draft</button> --}}
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDiscardDraft()" wire:loading.attr="disabled">
                <span wire:loading.remove>Discard Draft</span>
                <span wire:loading>Discarding...</span>
            </button>
            @endif
        </div>
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
            {{-- <li class="nav-item">
                <a href="#step-5" wire:click="back(5)" class="nav-link {{ $currentStep == 5 ? 'active' : '' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Run</a>
            </li> --}}
            <li class="nav-item">
                <a href="#step-5" class="nav-link {{ $currentStep == 5 ? 'active' : 'disabled' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Preview</a>
            </li>
        </ul>
        <div class="progress mb-2" style="height: 4px;">
            <div id="wizard-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress mb-2" style="height: 4px;">
            <div id="wizard-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
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
            <!-- <h4>Bioproject</h4> -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Bioproject Selection</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" id='searchBioproject' wire:model="searchBioproject" class="form-control" placeholder="Search Bioproject here">
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
                                <tr class="bioprojects">
                                    <th scope="row"><input type="radio" name="bioproject_id" wire:model="bioproject_id" value="{{$bioproject->id}}" @if (old('bioproject_id')==$bioproject->id) ) checked @endif></th>
                                    <td>{{$bioproject->accession}}</td>
                                    <td>{{$bioproject->submission_id}}</td>
                                    <td class="bioprojectsTitles">{{$bioproject->title}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    @error('bioproject_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    @error('bioproject_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
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
                            <input type="text" id='searchBiosample' wire:model="searchBiosample" class="form-control" placeholder="Search here">
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
                                <tr class="biosamples" title="{{$biosample->title}}">
                                    <th scope="row"><input type="checkbox" name="biosample_id[]" id="{{ rand() }}" wire:model="biosample_id.{{ $biosample->id }}" value="{{$biosample->id}}" @if(is_array(old('biosample_id')) && in_array($biosample->id, old('biosample_id'))) checked @endif></th>
                                    <td>{{$biosample->accession}}</td>
                                    <td>{{$biosample->submission_id}}</td>
                                    <td class="biosamplesTitles">{{$biosample->title}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @error('biosample_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    @error('biosample_id')
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
                                    <th scope="col">Title <font color="red">*</font></th>
                                    <th scope="col">Library Name <font color="red">*</font></th>
                                    <th scope="col">Library Source <font color="red">*</font></th>
                                    <th scope="col">Library Selection <font color="red">*</font></th>
                                    <th scope="col">Library Strategy <font color="red">*</font></th>
                                    <th scope="col">Library Construction Protocol <font color="red">*</font></th>
                                    <th scope="col">Instrument <font color="red">*</font></th>
                                    <th scope="col">Library Layout <font color="red">*</font></th>
                                    <th scope="col">Insert Size <font color="red">*</font></th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                $alias = $this->alias;
                                @endphp
                                @php
                                $no = 1;
                                $alias = $this->alias;
                                @endphp
                                @foreach ($biosample_id as $id => $experiment)
                                <tr>
                                    <!-- {{$id}} -->
                                    <td>{{$no}}</td>
                                    <td>
                                        {{$alias_exp[$id] = "INNAX-".$alias."-".$no }}
                                        {{-- <input type="text" name="bioexperiment_id[{{$id}}][alias_exp]" wire:model="bioexperiment_id.{{$id}}.alias_exp" value="{{$alias}}" disabled>
                                        @error('bioexperiment_id.*.alias_exp')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror --}}
                                    </td>
                                    <td>{{$this->biosampleSubmission($id)}} : {{$this->biosampleName($id)}}</td>
                                    <td>
                                        <input type="text" name="bioexperiment_id[{{$id}}][title]" wire:model="bioexperiment_id.{{$id}}.title">
                                        @error('bioexperiment_id.*.title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="bioexperiment_id[{{$id}}][libname]" wire:model="bioexperiment_id.{{$id}}.libname">
                                        @error('bioexperiment_id.*.libname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        {{-- <select name="bioexperiment_id[{{$id}}][libsource_id]" wire:model="bioexperiment_id.{{$id}}.libsource_id"> --}}
                                        <select name="bioexperiment_id[{{$id}}][libsource_id]" wire:model="bioexperiment_id.{{$id}}.libsource_id">
                                            <option value="">Select Lib Source</option>
                                            @foreach ( $libsources as $libsource )
                                            <option value="{{$libsource->id}}" @if (old('libsource_id')==$libsource->id) selected @endif>{{$libsource->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{-- <select name="bioexperiment_id[{{$id}}][libselection_id]" wire:model="bioexperiment_id.{{$id}}.libselection_id"> --}}
                                        <select name="bioexperiment_id[{{$id}}][libselection_id]" wire:model="bioexperiment_id.{{$id}}.libselection_id">
                                            <option value="">Select Lib Selection</option>
                                            @foreach ( $libselections as $libselection )
                                            <option value="{{$libselection->id}}" @if (old('libselection_id')==$libselection->id) selected @endif>{{$libselection->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{-- <select name="bioexperiment_id[{{$id}}][libstrategy_id]" wire:model="bioexperiment_id.{{$id}}.libstrategy_id"> --}}
                                        <select name="bioexperiment_id[{{$id}}][libstrategy_id]" wire:model="bioexperiment_id.{{$id}}.libstrategy_id">
                                            <option value="">Select Lib Strategy</option>
                                            @foreach ( $libstrategies as $libstrategy )
                                            <option value="{{$libstrategy->id}}" @if (old('libstrategy_id')==$libstrategy->id) selected @endif>{{$libstrategy->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    {{-- <td><input type="text" name="bioexperiment_id[{{$id}}][libconsprot]" wire:model="bioexperiment_id.{{$id}}.libconsprot"></td> --}}
                                    <td><input type="text" name="bioexperiment_id[{{$id}}][libconsprot]" wire:model="bioexperiment_id.{{$id}}.libconsprot"></td>
                                    <td>
                                        <select name="bioexperiment_id[{{$id}}][instrument_id]" wire:model="bioexperiment_id.{{$id}}.instrument_id">
                                            <option value="0">Select Instrument</option>
                                            @foreach ( $instruments as $instrument )
                                            <option value="{{$instrument->id}}" @if (old('instrument_id')==$instrument->id) selected @endif>{{$instrument->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        {{-- <select name="bioexperiment_id[{{$id}}][liblayout_id]" wire:model="bioexperiment_id.{{$id}}.liblayout_id"> --}}
                                        <select name="bioexperiment_id[{{$id}}][liblayout_id]" wire:model="bioexperiment_id.{{$id}}.liblayout_id">
                                            <option value="">Select Lib Layout</option>
                                            @foreach ( $liblayouts as $liblayout )
                                            <option value="{{$liblayout->id}}" @if (old('liblayout_id')==$liblayout->id) selected @endif>{{$liblayout->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('bioexperiment_id.*.liblayout_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        {{-- @error('bioexperiment_id.*.liblayout_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror --}}
                                    </td>
                                    <td><input onkeydown="return numbersOnly(event)" onkeyup="this.value=this.value.replace(',','.')" type="text" name="bioexperiment_id[{{$id}}][inp_size]" wire:model="bioexperiment_id.{{$id}}.inp_size" ></td>
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
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Bioproject Accession </td>
                            <td>:</td>
                            <td><strong>{{$this->bioprojectName($this->bioproject_id)}}</strong></td>
                        </tr>
                        <tr>
                            <td>biosample</td>
                            {{-- <td>{{$this->biosample_id[9]}}</td> --}}
                            <td>:</td>
                            <td>
                                <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                                    @foreach ($this->biosample_id as $item => $value)
                                    <tr>
                                        <td>
                                            {{$this->biosampleName($this->biosample_id[$item])}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>bioexperiment</td>
                            <td>:</td>
                            <td>
                                <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                                    @if ($currentStep >= 5)
                                    @foreach ($bioexperiment_id as $item => $value)
                                    <tr>
                                        <td><b>{{$this->biosampleName($item)}}</b></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Alias</td>
                                        <td></td>
                                        <td>{{$alias_exp[$item]}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Title</td>
                                        <td></td>
                                        <td>{{$bioexperiment_id[$item]['title']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Library Name</td>
                                        <td></td>
                                        <td>{{$bioexperiment_id[$item]['libname']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Library Source</td>
                                        <td></td>
                                        <td>{{$this->libsourceName($bioexperiment_id[$item]['libsource_id'])}}</td>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <td>Experiment Library Selection</td>
                                        <td></td>
                                        <td>{{$this->libselectionName($bioexperiment_id[$item]['libselection_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Library Strategy</td>
                                        <td></td>
                                        <td>{{$this->libstrategyName($bioexperiment_id[$item]['libstrategy_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Library cons Protocol</td>
                                        <td></td>
                                        <td>{{$bioexperiment_id[$item]['libconsprot']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Instrument</td>
                                        <td></td>
                                        <td>{{$this->instrumentName($bioexperiment_id[$item]['instrument_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Library Layout</td>
                                        <td></td>
                                        <td>{{$this->liblayoutName($bioexperiment_id[$item]['liblayout_id'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Experiment Input Size</td>
                                        <td></td>
                                        <td>{{$bioexperiment_id[$item]['inp_size']}}</td>
                                    </tr>

                                    @endforeach
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Back</button>
            <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
        </div>
    </div>

</form>
@push('js')
<script>
    document.addEventListener('livewire:load', function() {
        const steps = document.querySelectorAll('#nav-steps .nav-item').length;
        document.getElementById('wizard-progress').style.width = 100 / steps * @this.currentStep + "%"
    })
    document.addEventListener('livewire:update', function() {
        $('.form-select.select2').each(function() {
            $(this).select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: 'Select an option'
            })
            $(this).on('change', function(e) {
                @this.set($(this).attr("wire:model"), $(this).select2("val"));
            });
        });

        let timer = null
        $('#searchBioproject').on('keyup',function(){
            // console.log($(this).val());
            // // console.log($(this).attr("wire:model"));
            // @this.set($(this).attr("wire:model"), $(this).val());
            clearTimeout(timer);
            const bioprojectRows = document.getElementsByClassName('bioprojects')
            const bioprojectTitles = document.getElementsByClassName('bioprojectsTitles')
            timer = setTimeout(() => {
                for (let i = 0; i<bioprojectTitles.length; i++ )
                {
                    console.log(bioprojectTitles[i].innerHTML)
                    if (!bioprojectTitles[i].innerHTML.toLowerCase().includes($(this).val().toLowerCase()))
                    {
                        bioprojectRows[i].classList.add("d-none")
                    }
                    else {
                        bioprojectRows[i].classList.remove("d-none")
                    }
                }
            }, 500)

        })

        $('#searchBiosample').on('keyup',function(){
            // console.log($(this).val());
            // // console.log($(this).attr("wire:model"));
            // @this.set($(this).attr("wire:model"), $(this).val());
            clearTimeout(timer);
            const biosampleRows = document.getElementsByClassName('biosamples')
            const biosampleTitles = document.getElementsByClassName('biosamplesTitles')
            timer = setTimeout(() => {
                for (let i = 0; i<biosampleTitles.length; i++ )
                {
                    console.log(biosampleTitles[i].innerHTML)
                    if (!biosampleTitles[i].innerHTML.toLowerCase().includes($(this).val().toLowerCase()))
                    {
                        biosampleRows[i].classList.add("d-none")
                    }
                    else {
                        biosampleRows[i].classList.remove("d-none")
                    }
                }
            }, 500)

        })

        const steps = document.querySelectorAll('#nav-steps .nav-item').length;
        document.getElementById('wizard-progress').style.width = 100 / steps * @this.currentStep + "%";
        const biosample_id = document.getElementsByName('biosample_id[]')
        let biosample_true = Object.assign({}, @this.get('biosample_id'))
        biosample_id.forEach(element => {
            element.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    let val = {
                        [event.currentTarget.value]: event.currentTarget.value
                    }
                    biosample_true = {
                        ...biosample_true,
                        ...val
                    };
                } else {
                    delete biosample_true[event.currentTarget.value]
                }
                @this.set('biosample_id', biosample_true)
            })
        });
    })

    function numbersOnly(event) {
        var key = event.keyCode;
        return ((key >= 96 && key <= 105) || (key >= 48 && key <= 57) || key == 188 || key==46 || key==8);
    };

    // Handle draft-loaded event dispatched from Livewire when a draft is restored
    document.addEventListener('draft-loaded', function(e) {
        const data = e.detail?.draft || {};

        // restore biosample checkboxes state
        if (data.biosample_id) {
            document.querySelectorAll('input[type="checkbox"][name^="biosample_id"]').forEach(cb => {
                try {
                    const checked = (typeof data.biosample_id === 'object') ? (data.biosample_id.hasOwnProperty(cb.value) || data.biosample_id[cb.value]) : (Array.isArray(data.biosample_id) && data.biosample_id.includes(cb.value));
                    cb.checked = !!checked;
                    cb.dispatchEvent(new Event('change', { bubbles: true }));
                } catch (err) {
                    // ignore per-item errors
                    console.debug('draft checkbox restore error', err);
                }
            });
        }

        // restore select/select2 values for bioexperiment rows
        if (data.bioexperiment_id) {
            for (const [sampleId, obj] of Object.entries(data.bioexperiment_id)) {
                ['libsource_id','libselection_id','libstrategy_id','instrument_id','liblayout_id'].forEach(name => {
                    try {
                        const selector = document.querySelector(`select[name="bioexperiment_id[${sampleId}][${name}]"]`);
                        if (!selector) return;
                        const val = obj[name];
                        if (val === undefined || val === null || val === '') return;
                        // if select2 active, append option if missing then set value and trigger change
                        if ($(selector).hasClass('select2-hidden-accessible') || $(selector).hasClass('select2')) {
                            if (!selector.querySelector(`option[value="${val}"]`)) {
                                const opt = document.createElement('option'); opt.value = val; opt.text = val; selector.appendChild(opt);
                            }
                            $(selector).val(val).trigger('change');
                        } else {
                            selector.value = val;
                            selector.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    } catch (err) {
                        console.debug('draft select restore error', err);
                    }
                })
            }
        }
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
                // fallback toast
                alert(message);
            }
        } catch (err) {
            console.debug('ajax-alert handler error', err);
            try { alert(message); } catch (e) {}
        }
    })

    // Show confirmation modal before discarding a draft
    function confirmDiscardDraft() {
        try {
            bsConfirmModalTitle.textContent = 'Discard Draft';
            bsConfirmModalText.textContent = 'Are you sure you want to discard the current draft? This action cannot be undone.';
            bsConfirmModalSpinner.classList.add('d-none');
            // show modal
            bsConfirmModal.show();

            const handler = function() {
                // show spinner while Livewire processes
                bsConfirmModalSpinner.classList.remove('d-none');
                // call Livewire discardDraft method
                try { @this.call('discardDraft'); } catch (e) { console.debug('Livewire call failed', e); }
                // hide modal; actual page reload will happen when 'draft-discarded' event fires
                bsConfirmModal.hide();
            };

            // attach one-time handler to modal confirm button
            bsConfirmModalButton.addEventListener('click', handler, { once: true });
        } catch (err) {
            console.debug('confirmDiscardDraft error', err);
            if (confirm('Discard draft?')) {
                try { @this.call('discardDraft'); } catch (e) {}
            }
        }
    }

    // Reload page when draft is discarded server-side
    document.addEventListener('draft-discarded', function() {
        // small delay to allow alert to show briefly
        setTimeout(() => { window.location.reload(); }, 250);
    })

</script>
@endpush
