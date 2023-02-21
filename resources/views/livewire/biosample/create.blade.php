<form wire:submit.prevent="submitForm">
    <div>
        @if(!empty($successMsg))
        <div class="alert alert-success">
            {{ $successMsg }}
        </div>
        @endif
        <ul id="nav-steps" class="nav nav-pills mb-2 nav-justified">
            <li class="nav-item">
                <a href="#step-1" wire:click="back(1)" class="nav-link {{ $currentStep == 1 ? 'active' : '' }}  {{ $currentStep < 1 ? 'disabled' : '' }}">Submitter Information</a>
            </li>
            <li class="nav-item">
                <a href="#step-2" wire:click="back(2)" class="nav-link {{ $currentStep == 2 ? 'active' : ''  }} {{ $currentStep < 2 ? 'disabled' : '' }}">General Information</a>
            </li>
            <li class="nav-item">
                <a href="#step-3" wire:click="back(3)" class="nav-link {{ $currentStep == 3 ? 'active' : ''  }} {{ $currentStep < 3 ? 'disabled' : '' }}">Sample Information</a>
            </li>
            <li class="nav-item">
                <a href="#step-4" wire:click="back(4)" class="nav-link {{ $currentStep == 4 ? 'active' : '' }} {{ $currentStep < 4 ? 'disabled' : '' }}">Sample Attributes</a>
            </li>
            <li class="nav-item">
                <a href="#step-5" class="nav-link {{ $currentStep == 5 ? 'active' : 'disabled' }} {{ $currentStep < 5 ? 'disabled' : '' }}">Preview</a>
            </li>
        </ul>
        <div class="progress mb-2"  style="height: 4px;">
            <div id="wizard-progress"  class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
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
                <!--div class="card mb-4">
                    <div class="card-header">
                        <h5>Description</h5>
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
                    </div>
                </div-->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Release Date<font color="red">*</font></h5>
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
                                        <input type="text" name="biosample_links[{{$index}}][link_description]" class="form-control" value="{{$biosample_link['link_description']}}" wire:model="biosample_links.{{$index}}.link_description">
                                        @error('biosample_links.*.link_description')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="biosample_links[{{$index}}][link_url]" class="form-control" value="{{$biosample_link['link_url']}}" wire:model="biosample_links.{{$index}}.link_url">
                                        @error('biosample_links.*.link_url')
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
                        @foreach ($packages as $index => $package)
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="package_id" wire:click="resetSampletype" wire:model="package_id" value="{{$package->id}}" @if (old('package_id')==$package->id)
                        ) checked @endif>
                                    <label class="form-check-label">{{$package->name}}</label>
                                </div>
                            </div>
                        </div>
                        @if ($index+1 == $package_id)
                            @foreach ($sampletypes as $sampletype )
                                @if ($package_id == $sampletype->sampletype_package_id)
                                <div class="row">&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sampletype_id" wire:model="sampletype_id" value="{{$sampletype->id}}" >
                                            <label class="form-check-label">{{$sampletype->name}}</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        @endforeach
                        
                        
                        @error('sampletype_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror    
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger nextBtn  pull-right" type="button" wire:click="back(2)">Back</button>
                <button class="btn btn-primary nextBtn  pull-right" type="button" wire:click="thirdStepSubmit">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 4 ? 'display-none' : '' }}" id="step-4">
            <div class="col-md-12">
                <h3>Sample Attributes</h3>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>@if (!is_null($sample_find)) {{$sample_find->name}} @endif Attributes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @if (!empty($attributes) )
                                @foreach ($attributes->chunk(4) as $row)
                                <div class="row g-2">
                                    @foreach ($row as $attr)
                                    <div class="col-md-1">
                                        <label for="{{$attr->attr_name}}" class="form-label">{{$attr->attr_text}}@if(in_array((string)$attr->id, $attribute_M))<font color="red">*</font>@endif</label>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($attr->input_type_id == 1)
                                        <input type="text" class="form-control @error('{{$attr->attr_name}}}') is-invalid @enderror" wire:model="{{$attr->attr_name}}" id="{{$attr->attr_name}}" name="{{$attr->attr_name}}" value="" >
                                        @elseif ($attr->input_type_id == 2)
                                        <input type="textarea" class="form-control @error('{{$attr->attr_name}}}') is-invalid @enderror" wire:model="{{$attr->attr_name}}" id="{{$attr->attr_name}}" name="{{$attr->attr_name}}" value="" >
                                        @elseif ($attr->input_type_id == 3)
                                            <select class="form-select" wire:model="{{$attr->attr_name}}" id="{{$attr->attr_name}}" name="{{$attr->attr_name}}" >
                                                <option value="">--{{$attr->attr_name}}--</option>
                                                @foreach(explode(',',$attr->list_value) as $atname)
                                                    <option value="{{$atname}}">{{$atname}}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($attr->input_type_id == 4)
                                        <input type="date" name="{{$attr->attr_name}}" id="{{$attr->attr_name}}" class="form-control  @error('{{$attr->attr_name}}}') is-invalid @enderror" wire:model="{{$attr->attr_name}}" style="width: 100%; display: inline;" >
                                        @elseif ($attr->input_type_id == 7)
                                            <select class="form-select" wire:model="{{$attr->attr_name}}_id" id="{{$attr->attr_name}}_id" name="{{$attr->attr_name}}_id" >
                                                <option value="">--{{$attr->attr_name}}--</option>
                                                @foreach(${$attr->attr_name} as $atname)
                                                    <option value="{{$atname->id}}">{{$atname->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                
                </div>
            
            <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(3)">Back</button>
            <button class="btn btn-primary nextBtn  pull-right" type="button" wire:click="fourthStepSubmit">Next</button>
            </div>
        </div>
        <div class="row setup-content {{ $currentStep != 5 ? 'display-none' : '' }}" id="step-5">
            <div class="col-md-12">
                <h3>Preview</h3>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Submitter</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                
                            <table class="table">
                                <tr>
                                    <td>Name:</td>
                                    <td><label>{{$submitter_name}}</label></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><label>{{$submitter_email}}</label></td>
                                </tr>
                                <tr>
                                    <td>Lab:</td>
                                    <td><label>{{$submitter_lab}}</label></td>
                                </tr>
                                <tr>
                                    <td>Organization:</td>
                                    <td><label>{{$submitter_center}}</label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Release Date</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <table class="table">
                                <tr>
                                    <td>Release Date:</td>
                                    @if ($hold_release == true)
                                    <td><label>Hold (not viewable until the release of linked data)</label></td>
                                    @else
                                    <td><label>After the approval is passed, release immediately following curation</label></td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>External Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <table class="table">
                                <tr>
                                    <td>Link Description:</td>
                                    <td>Link URL:</td>
                                </tr>
                                @foreach ($biosample_links as $index => $biosample_link)
                                <tr>
                                    <td>{{$biosample_link['link_description']}}</td>
                                    <td>{{$biosample_link['link_url']}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <table class="table">
                                <tr>
                                    <td>Comments:</td>
                                    <td><label>{{$comments}}</label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Sample Type</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <table class="table">
                                <tr>
                                    <td>Sample type:</td>
                                    <td><label>@if (!is_null($sample_find)) {{$sample_find->name}} @endif</label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Sample Attributes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @if (!empty($attributes))
                                @foreach ($attributes->chunk(4) as $row)
                                <div class="row g-2">
                                    @foreach ($row as $attr)
                                    <div class="col-md-1">
                                        <label for="{{$attr->attr_name}}" class="form-label">{{$attr->attr_text}} </label>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($attr->input_type_id == 7)
                                            @if ((${($attr->attr_name.'_id')})!='')
                                            <label>: {{(${$attr->attr_name})[(${($attr->attr_name.'_id')})-1]->name}}</label>
                                            @endif
                                        @else
                                        <label>: {{(${$attr->attr_name})}}</label>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <button class="btn btn-danger nextBtn pull-right" type="button" wire:click="back(4)">Back</button>
                <button class="btn btn-success pull-right" wire:click="submitForm" type="button">Finish!</button>
            </div>
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