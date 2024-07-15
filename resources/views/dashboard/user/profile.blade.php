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
@if (!isset(auth()->user()->center_id) || !isset(auth()->user()->lab_id))
<div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
    <strong>Please complete your profile!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Data </h5>
                <form method="post" action="{{route('users.profile.update')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{auth()->user()->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name <span class="text-danger">*</span></label>
                        <input type="text" disabled class="form-control @error('username') is-invalid @enderror" id="username" name="username" readonly value="{{auth()->user()->username}}">

                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" disabled class="form-control @error('email') is-invalid @enderror" id="email" name="email" readonly value="{{auth()->user()->email}}">

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
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="role" id="role" readonly disabled>
                            <option value="" disabled selected >Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{auth()->user()->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="center_id" class="form-label">Center <span class="text-danger">*</span></label>
                        <select class="form-select @if (!auth()->user()->center_id) is-invalid @endif" name="center_id" id="center_id">
                            <option value="" disabled selected >Select Center</option>
                            @foreach ($centers as $center)
                            <option value="{{$center->id}}" {{auth()->user()->center_id == $center->id ? 'selected' : ''}}>{{$center->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a Center. If your center is not listed, please contact the administrator at <a href=mailto:inna.repository@brin.go.id>inna.repository@brin.go.id</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="lab_id" class="form-label">Lab <span class="text-danger">*</span></label>
                        <select class="form-select @if (!auth()->user()->center_id) is-invalid @endif" name="lab_id" id="lab_id">
                            <option value="" disabled selected >Select Lab</option>
                            @foreach ($labs as $lab)
                            <option value="{{$lab->id}}" {{auth()->user()->lab_id == $lab->id ? 'selected' : ''}}>{{$lab->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a Lab. If your center is not listed, please contact the administrator at <a href=mailto:inna.repository@brin.go.id>inna.repository@brin.go.id</a>
                        </div>
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
