@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 mt-3 mb-3 fw-normal text-center">Register Form</h1>
            <form action="/register" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name')
                     is-invalid   
                    @enderror" id="name" placeholder="Your Name" required value="{{ old('name') }}">
                    <label for="floatingInput">Name</label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control  @error('username') is-invalid @enderror" id="username" placeholder="Your UserName" required value="{{ old('username') }}">
                    <label for="floatingInput">User Name</label>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Your Email" required value="{{ old('email') }}">
                    <label for="floatingInput">Email Address</label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <label for="floatingInput" class="form-label">Lab</label>
                    <select class="form-select" name="lab" id="lab">
                        <option value=""></option>
                        @foreach ($labs as $lab )
                        <option value="{{$lab->id}}" @if (old('lab')==$lab->id) selected @endif>{{$lab->name}}</option>
                        @endforeach
                    </select>

                    @error('lab')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="orcid_id" class="form-control @error('orcid_id') is-invalid @enderror" id="orcid_id" placeholder="Your ORCID ID" required value="{{ old('orcid_id') }}">
                    <label for="floatingInput">ORCID ID</label>
                    @error('orcid_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id=" password" placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control rounded-bottom" id="password_confirmation" placeholder="Password Confirmation" required>
                    <label for="password_confirmation">Password Confirmation</label>
                </div>
                <button class="w-100 btn btn-lg btn-danger" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">
                <a href="/login">Already Registered</a>
            </small>
        </main>
    </div>
</div>


@endsection
@push('js')

@endpush