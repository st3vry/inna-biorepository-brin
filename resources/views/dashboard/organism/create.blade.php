@extends('dashboard.layouts.main')
@section('title', 'Create New Organism')
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-8">
            <div class="card-body">
                <form method="post" action="/dashboard/organisms">
                    @csrf
                    <div class="mb-3">
                        <label for="taxon_id" class="form-label">Taxon ID</label>
                        <input type="text" class="form-control @error('taxon_id') is-invalid @enderror" id="taxon_id" name="taxon_id" required autofocus value="{{old('taxon_id')}}">
                        @error('taxon_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name')}}">

                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Organism</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection