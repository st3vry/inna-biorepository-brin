@extends('dashboard.layouts.main')
@section('title', 'Create New Role')
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-8">
            <div class="card-body">
                <form method="post" action="/dashboard/roles">
                    @csrf
                    <!-- <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required autofocus value="{{old('code')}}">
                        @error('code')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div> -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name')}}">

                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-8">
</div>

@endsection