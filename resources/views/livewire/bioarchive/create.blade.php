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
                    <a href="#step-2" type="button" class="btn {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">General Info</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button" class="btn {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">Project Type</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-4" type="button" class="btn {{ $currentStep != 4? 'btn-default' : 'btn-primary' }}">Target</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-5" type="button" class="btn {{ $currentStep != 5 ? 'btn-default' : 'btn-primary' }}">Publication</a>

                </div>
                <div class="multi-wizard-step">
                    <a href="#step-6" type="button" class="btn {{ $currentStep != 6 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">Preview</a>

                </div>
            </div>
        </div>
    </div>
</form>