@extends('layouts.main')
@section('container')
<div class="container mt-3">
    <h1>Halaman Profile</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
</div>

@endsection