<form>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model.lazy="title" id="title" name="title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="umbrella" class="form-label">Umbrella Project</label>
        <select class="form-select" name="umbproject_id" wire:model="selectedUmbrella" id="umbproject_id">
            <option value="">Umbrella Project</option>
            @foreach ($umbrellas as $umbrella )
            <option value="{{$umbrella->id}}" @if (old('umbproject_id')==$umbrella->id) selected @endif>{{$umbrella->title}}</option>
            @endforeach
        </select>

        @error('umbproject_id')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="organism" class="form-label">Organism</label>
        <select class="form-select" name="organism_id" id="organism_id" wire:model="selectedOrganism">
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
        <label for="relevance" class="form-label">Relevance</label>
        <input type="text" class="form-control @error('relevance') is-invalid @enderror" id="relevance" wire:model="relevance" name="relevance" value="{{old('relevance')}}">
        @error('relevance')
        <div class="invalid-feedback">{{$message}}</div>
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
                    <input class="form-check-input" type="checkbox" name="data_type_id[]" wire:model="selectedDatatypes" value="{{$datatype->id}}" @if(is_array(old('data_type_id')) && in_array($datatype->id, old('data_type_id'))) checked @endif>
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
                    <input class="form-check-input" type="radio" name="samplescope_id" wire:model="selectedSampleScope" value="{{$samplescope->id}}" @if (old('samplescope_id')==$samplescope->id)) checked @endif>
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
                            @if ($editedGrantIndex !== $index)
                            {{$grant['fundagency']['name']}}
                            @else
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="grants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            {{$grant['grant_program']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][program]" class="form-control" value="{{$grant['grant_program']}}" wire:model="grants.{{$index}}.grant_program">
                            @error('newGrants.*.grant_program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>@if ($editedGrantIndex !== $index)
                            {{$grant['grant_title']}}
                            @else
                            <input type="text" name="newGrants[{{$index}}][title]" class="form-control" value="{{$grant['grant_title']}}" wire:model="grants.{{$index}}.grant_title">
                            @error('newGrants.*.grant_title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            @endif

                        </td>
                        <td>
                            @if ($editedGrantIndex !== $index)
                            <button class="btn btn-sm btn-primary" wire:click.prevent="editGrant({{$index}})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click.prevent="deleteGrant({{$index}})">Delete</button>
                            @else
                            <button class="btn btn-sm btn-warning" wire:click.prevent="saveGrant({{$index}})">Save</button>
                            @endif
                        </td>
                        <!-- <td>{{$grant['grant_program']}}</td> -->
                        <!-- <td>{{$grant['grant_title']}}</td> -->
                    </tr>
                    @endforeach
                    @foreach ($newGrants as $index => $newGrant )
                    <tr>

                        {{$newGrants[0]['grant_title']}}
                        <td>
                            <select class="form-select" name="newGrants[{{$index}}][fundagency_id]" wire:model="newGrants.{{$index}}.fundagency_id">
                                <option value="">Funding Agency</option>
                                @foreach ($fundagencies as $fundagency )
                                <option value="{{$fundagency->id}}">{{$fundagency->name}}</option>
                                @endforeach
                            </select>
                            @error('newGrants.*.fundagency_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_program]" class="form-control" value="{{$newGrant['grant_program']}}" wire:model="newGrants.{{$index}}.grant_program">
                            @error('newGrants.*.program')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text" name="newGrants[{{$index}}][grant_title]" class="form-control" value="{{$newGrant['grant_title']}}" wire:model="newGrants.{{$index}}.grant_title">
                            @error('newGrants.*.title')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger delete_row" wire:click.prevent="removeGrant({{$index}})">remove</button>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-secondary" wire:click.prevent="newGrant">+ Add Another Grant</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->


    <button wire:click.prevent="update()" class="btn btn-primary">Update Bioproject</button>
</form>