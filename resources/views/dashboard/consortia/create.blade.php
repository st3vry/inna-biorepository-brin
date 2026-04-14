@extends('dashboard.layouts.main')
@section('title', 'Create Consortia')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form method="post" action="/dashboard/consortium">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name')}}">

                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="url" class="form-label">Url</label>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" required value="{{old('url')}}">

                        @error('url')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Consortia</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection