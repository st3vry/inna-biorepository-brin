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
                    <a href="#step-1" type="button" class="btn {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                    <p>Step 1</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                    <p>Step 2</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
            <div class="col-md-12">
                <h3> Step 1</h3>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" id="title" name="title" value="{{old('title')}}">
                    @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <button class="btn btn-primary nextBtn pull-right" wire:click="firstStepSubmit" type="button">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
            <div class="col-md-12">
                <h3> Step 2</h3>


                <button class="btn btn-danger nextBtn  pull-right" type="button" wire:click="back(1)">Back</button>
                <button class="btn btn-primary nextBtn  pull-right" type="button" wire:click="secondStepSubmit">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
            <div class="col-md-12">
                <h3> Step 3</h3>
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

                <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(2)">Back</button>
                <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            </div>
        </div>

    </div>

</form>