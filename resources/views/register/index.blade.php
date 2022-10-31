@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Register Form</h1>
            <form>
                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top" id="name" placeholder="Your Name">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Your UserName">
                    <label for="floatingInput">User Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Your Email">
                    <label for="floatingInput">Email Address</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="lab" class="form-control" id="lab" placeholder="Your Lab">
                    <label for="floatingInput">Lab</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="orcid_id" class="form-control" id="orcid_id" placeholder="Your ORCID ID">
                    <label for="floatingInput">ORCID ID</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-danger" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3">
                <a href="/login">Already Registered</a>
            </small>
        </main>
    </div>
</div>


@endsection