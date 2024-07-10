@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3 border-bottom">
    <h1>Input Administrative Data</h1>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/administratives">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{old('name')}}">

            @error('name')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
       
        <button type="submit" class="btn btn-primary">Create Administrative</button>
    </form>
</div>

@endsection