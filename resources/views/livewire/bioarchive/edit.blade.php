<div class="container-fluid">
    <div class="row">
        <form wire:submit.prevent="submitForm">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Bioarchive</h4>
            </div>

            <div class="card-body">
                <div>
                    <ul id="nav-steps" class="nav nav-pills mb-2 nav-justified bg-light p-1 rounded">
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
                            <a href="#step-5" class="nav-link {{ $currentStep == 5 ? 'active' : 'disabled' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Preview</a>
                        </li>
                    </ul>
                    <div class="progress mb-2" style="height: 4px;">
                        <div id="wizard-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
        <div class="col-md-12">
            <h4>Submitter Info</h4>
            <div class="card mb-4">
                <div class="card-header"><h5>Submitter</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name <font color="red">*</font></label>
                        <input type="text" class="form-control" wire:model="submitter_name" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email <font color="red">*</font></label>
                        <input type="text" class="form-control" wire:model="submitter_email" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Lab <font color="red">*</font></label>
                        <input type="text" class="form-control" wire:model="submitter_lab_name" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Center <font color="red">*</font></label>
                        <input type="text" class="form-control" wire:model="submitter_center_name" disabled>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><h5>Data Release <font color="red">*</font></h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="1">
                            <label class="form-check-label">Hold (not viewable until the release of linked data)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hold_release" wire:model="hold_release" value="0">
                            <label class="form-check-label">Release immediately (After the approval is passed, release immediately following curation)</label>
                        </div>
                        @error('hold_release')
                        <p class="text-danger mb-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" wire:click="firstStepSubmit" type="button">Next</button>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header"><h5>Bioproject Selection</h5></div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" id='searchBioproject' wire:model="searchBioproject" class="form-control" placeholder="Search by title">
                        </div>
                    </div>
                    <div class="overflow-auto" style="width:100%;max-width: 100%; height: 500px;">
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
                                    <th scope="row"><input type="radio" name="bioproject_id" wire:model="bioproject_id" value="{{$bioproject->id}}"></th>
                                    <td>{{$bioproject->accession}}</td>
                                    <td>{{$bioproject->submission_id}}</td>
                                    <td class="bioprojectsTitles">{{$bioproject->title}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('bioproject_id')
                    <p class="text-danger mb-0">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <button class="btn btn-danger" type="button" wire:click="back(1)">Back</button>
            <button class="btn btn-primary" type="button" wire:click="secondStepSubmit">Next</button>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header"><h5>Biosample Selection</h5></div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" id='searchBiosample' wire:model="searchBiosample" class="form-control" placeholder="Search by title">
                        </div>
                    </div>
                    <div class="overflow-auto" style="width:100%;max-width: 100%; height: 500px;">
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
                                    <th scope="row">
                                        <input type="checkbox" name="biosample_id[]" wire:model="biosample_id.{{ $biosample->id }}" value="{{$biosample->id}}">
                                    </th>
                                    <td>{{$biosample->accession}}</td>
                                    <td>{{$biosample->submission_id}}</td>
                                    <td class="biosamplesTitles">{{$biosample->title}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('biosample_id')
                    <p class="text-danger mb-0">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <button class="btn btn-danger" type="button" wire:click="back(2)">Back</button>
            <button class="btn btn-primary" type="button" wire:click="thirdStepSubmit">Next</button>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header"><h5>Experiment</h5></div>
                <div class="card-body">
                    <div class="overflow-auto" style="width:100%;max-width: 100%;">
                        @php $no = 1; @endphp

                        @forelse ($biosample_id as $id => $experiment)
                            @php
                                $alias_exp[$id] = $experimentAlias[$id] ?? ('INNAX-' . $alias . '-' . $no);
                            @endphp

                            <div class="card mb-4 shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-start flex-wrap gap-2">
                                    <div>
                                        <div class="fw-bold">#{{ $no }} — {{ $alias_exp[$id] }}</div>
                                        <div class="text-muted small">Biosample: {{ $this->biosampleSubmission($id) }} : {{ $this->biosampleName($id) }}</div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="removeBiosample({{ $id }})" title="Remove">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="bioexperiment_id[{{ $id }}][title]" wire:model="bioexperiment_id.{{ $id }}.title">
                                            @error('bioexperiment_id.' . $id . '.title')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label class="form-label fw-bold">Library Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="bioexperiment_id[{{ $id }}][libname]" wire:model="bioexperiment_id.{{ $id }}.libname">
                                            @error('bioexperiment_id.' . $id . '.libname')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Library Source <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bioexperiment_id[{{ $id }}][libsource_id]" wire:model="bioexperiment_id.{{ $id }}.libsource_id">
                                                <option value="">Select Lib Source</option>
                                                @foreach ( $libsources as $libsource )
                                                    <option value="{{ $libsource->id }}">{{ $libsource->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bioexperiment_id.' . $id . '.libsource_id')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Library Selection <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bioexperiment_id[{{ $id }}][libselection_id]" wire:model="bioexperiment_id.{{ $id }}.libselection_id">
                                                <option value="">Select Lib Selection</option>
                                                @foreach ( $libselections as $libselection )
                                                    <option value="{{ $libselection->id }}">{{ $libselection->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bioexperiment_id.' . $id . '.libselection_id')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Library Strategy <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bioexperiment_id[{{ $id }}][libstrategy_id]" wire:model="bioexperiment_id.{{ $id }}.libstrategy_id">
                                                <option value="">Select Lib Strategy</option>
                                                @foreach ( $libstrategies as $libstrategy )
                                                    <option value="{{ $libstrategy->id }}">{{ $libstrategy->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bioexperiment_id.' . $id . '.libstrategy_id')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Library Construction Protocol <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="bioexperiment_id[{{ $id }}][libconsprot]" wire:model="bioexperiment_id.{{ $id }}.libconsprot">
                                            @error('bioexperiment_id.' . $id . '.libconsprot')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Instrument <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bioexperiment_id[{{ $id }}][instrument_id]" wire:model="bioexperiment_id.{{ $id }}.instrument_id">
                                                <option value="0">Select Instrument</option>
                                                @foreach ( $instruments as $instrument )
                                                    <option value="{{ $instrument->id }}">{{ $instrument->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bioexperiment_id.' . $id . '.instrument_id')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Library Layout <span class="text-danger">*</span></label>
                                            <select class="form-select" name="bioexperiment_id[{{ $id }}][liblayout_id]" wire:model="bioexperiment_id.{{ $id }}.liblayout_id">
                                                <option value="">Select Lib Layout</option>
                                                @foreach ( $liblayouts as $liblayout )
                                                    <option value="{{ $liblayout->id }}">{{ $liblayout->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('bioexperiment_id.' . $id . '.liblayout_id')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <label class="form-label fw-bold">Insert Size <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="bioexperiment_id[{{ $id }}][inp_size]" wire:model="bioexperiment_id.{{ $id }}.inp_size">
                                            @error('bioexperiment_id.' . $id . '.inp_size')
                                            <p class="text-danger mb-0">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php $no++; @endphp
                        @empty
                            <div class="alert alert-info mb-0">
                                No biosamples selected yet. Go back and select at least one biosample.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <button class="btn btn-danger" type="button" wire:click="back(3)">Back</button>
            <button class="btn btn-primary" type="button" wire:click="fourthStepSubmit">Next</button>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    @if ($currentStep >= 5)
                        <table class="table">
                            <tr>
                                <td>Bioarchive</td>
                                <td>:</td>
                                <td><strong>{{ $accession }}</strong></td>
                            </tr>
                            <tr>
                                <td>Bioproject Accession </td>
                                <td>:</td>
                                <td><strong>{{$this->bioprojectName($this->bioproject_id)}}</strong></td>
                            </tr>
                            <tr>
                                <td>biosample</td>
                                <td>:</td>
                                <td>
                                    <table class="m-auto table table-striped table-hover table-responsive text-nowrap">
                                        @foreach ($this->biosample_id as $item => $value)
                                        <tr>
                                            <td>{{$this->biosampleName($this->biosample_id[$item])}}</td>
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
                                        @foreach ($bioexperiment_id as $item => $value)
                                        <tr>
                                            <td><b>{{$this->biosampleName($item)}}</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Alias</td>
                                            <td></td>
                                            <td>{{$alias_exp[$item] ?? ($experimentAlias[$item] ?? '')}}</td>
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
                                    </table>
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>

            <button class="btn btn-danger" type="button" wire:click="back(4)">Back</button>
            <button class="btn btn-success" wire:click="submitForm" type="button">Update</button>
        </div>
    </div>

            </div> {{-- card-body --}}
        </div> {{-- card --}}
        </form>
    </div> {{-- row --}}
</div> {{-- container-fluid --}}

@push('js')
<script>
    document.addEventListener('livewire:load', function() {
        const steps = document.querySelectorAll('#nav-steps .nav-item').length;
        const el = document.getElementById('wizard-progress');
        if (el) el.style.width = 100 / steps * @this.currentStep + "%";
    })

    document.addEventListener('livewire:update', function() {
        const steps = document.querySelectorAll('#nav-steps .nav-item').length;
        const el = document.getElementById('wizard-progress');
        if (el) el.style.width = 100 / steps * @this.currentStep + "%";
    })
</script>
@endpush
