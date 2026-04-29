@extends('dashboard.layouts.main')
@section('title', 'Edit Role')
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-8">
            <div class="card-body">
                <form method="post" action="/dashboard/roles/{{$role->id}}">
                    @method('put')
                    @csrf
                    <!-- <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required autofocus value="{{old('taxon_id',$role->code)}}">
                        @error('code')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div> -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name',$role->name) }}">

                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection