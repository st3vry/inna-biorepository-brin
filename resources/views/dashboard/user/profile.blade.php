@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Profile Settings</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
    <strong> {{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
    <strong> {{session('error')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Data</h5>
                <form method="post" action="{{route('users.profile.update')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{auth()->user()->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" readonly value="{{auth()->user()->username}}">
            
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" readonly value="{{auth()->user()->email}}">
            
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="orcid_id" class="form-label">Orcid ID</label>
                        <input type="text" class="form-control @error('orcid_id') is-invalid @enderror" id="orcid_id" name="orcid_id" value="{{auth()->user()->orcid_id === 'none' ? '' : auth()->user()->orcid_id }}">
                        @error('orcid_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" readonly value="{{$role->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="lab" class="form-label">Lab</label>
                        <input type="text" class="form-control" id="lab" name="lab" readonly value="{{$lab->name}}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
                </form>
            </div>
        </div>
        
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Password</h5>
                <form class="form-horizontal" method="POST" action="{{route('users.password.update')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input id="current_password" type="password" class="form-control @if (session('current_password')) is-invalid @endif" name="current_password" required>
                        @if (session('current_password'))
                        <div class="invalid-feedback"> {{ session('current_password') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror @if (session('same_old_password')) is-invalid @endif"  name="new_password" required>
                        @if (session('same_old_password'))
                        <div class="invalid-feedback"> {{ session('same_old_password') }}</div>
                        @endif
                        @error('new_password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required>
                        @error('confirm_password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary float-end">Change Password</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection