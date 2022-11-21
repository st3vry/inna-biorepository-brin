<form wire:submit.prevent="submitForm">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" id="title" name="title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
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

    <div class="mb-3">
        <label for="material" class="form-label">Material</label>
        <select class="form-select" name="material_id" id="material_id" wire:model="material_id">
            <option value="">Material</option>
            @foreach ($materials as $material )
            <option value="{{$material->id}}" @if (old('material_id')==$material->id) selected @endif>{{$material->name}}</option>
            @endforeach
        </select>
        @if ($material_id==7)
        <label for="matdesc" class="form-label">Material Description</label>
        <input type="text" class="form-control @error('matdesc') is-invalid @enderror" wire:model="matdesc" id="matdesc" name="matdesc" value="{{old('reldesc')}}">
        @error('matdesc')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        @endif

        @error('material_id')
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
        <label for="capdesc" class="form-label">Capture Description</label>
        <input type="text" class="form-control @error('capdesc') is-invalid @enderror" wire:model="capdesc" id="capdesc" name="capdesc" value="{{old('reldesc')}}">
        @error('capdesc')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        @endif

        @error('capture_id')
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

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" wire:model="description" rows="3">{{old('description')}}</textarea>

        @error('description')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label class="mb-3">Data Type</label>
        @foreach ($datatypes->chunk(6) as $row)
        <div class="row">
            @foreach ( $row as $datatype)
            <div class="col-sm-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="data_type_id[]" wire:model="data_type_id.{{ $datatype->id }}" value="{{$datatype->id}}" @if(is_array(old('data_type_id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
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
        <label class="mb-3">Sample Scope</label>
        @foreach ($samplescopes->chunk(6) as $row)
        <div class="row">
            @foreach ( $row as $samplescope)
            <div class="col-sm-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="samplescope_id" wire:model="samplescope_id" value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id)) checked @endif>
                    <label class="form-check-label">{{$samplescope->name}}</label>
                </div>
            </div>

            @endforeach
        </div>
        @endforeach

        @error('samplescope_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

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
    <button type="submit" class="btn btn-primary">Create Bioproject</button>
</form>