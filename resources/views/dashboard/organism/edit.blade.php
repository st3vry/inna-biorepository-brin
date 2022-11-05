@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Edit Organism Data</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/organisms/{{$organism->id}}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="taxon_id" class="form-label">Taxon ID</label>
            <input type="text" class="form-control @error('taxon_id') is-invalid @enderror" id="taxon_id" name="taxon_id" required autofocus value="{{old('taxon_id',$organism->taxon_id)}}">
            @error('taxon_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name',$organism->name) }}">

            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit Organism</button>
    </form>
</div>

@endsection