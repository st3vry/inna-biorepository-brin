@extends('dashboard.layouts.main')
@section('title', 'Create Center')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="post" action="/dashboard/centers">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name')}}">

                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required value="{{old('address')}}">

                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" required value="{{old('website')}}">

                        @error('website')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Center</button>
                </form>
            </div>
        </div>
    </div>
</div>  

@endsection