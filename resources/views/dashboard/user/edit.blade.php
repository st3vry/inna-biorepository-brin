@extends('dashboard.layouts.main')
@section('title', 'Edit User ' . old('name', $user->name))
@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/dashboard/users/{{$user->id}}">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name',$user->name)}}">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{old('username',$user->username)}}">

                            @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email',$user->email)}}">

                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="orcid_id" class="form-label">Orcid ID</label>
                            <input type="text" class="form-control @error('orcid_id') is-invalid @enderror" id="orcid_id" name="orcid_id" value="{{old('orcid_id',$user->orcid_id)}}">

                            @error('orcid_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role_id">
                                @foreach ($roles as $role )
                                <option value="{{$role->id}}" @selected(old('role_id', $user->role_id) == $role->id)>{{$role->name}}</option>
                                @endforeach
                            </select>

                            @error('role_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lab_id" class="form-label">Lab</label>
                            <select class="form-select" name="lab_id">
                                @foreach ($labs as $lab )
                                <option value="{{$lab->id}}" @selected(old('lab' , $user->lab_id) == $lab->id)>{{$lab->name}} &mdash; {{$lab->center->name}}</option>
                                @endforeach
                            </select>

                            @error('lab')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-check mt-3 mb-3">
                            <input class="form-check-input" name="activate" type="checkbox" value="0" id="flexCheckDefault">
                            <input class="form-check-input" name="activate" type="checkbox" value="1" @checked($user->is_activated || old('activate',0)===1)
                            id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Activate ?
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit User</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
    


@endsection