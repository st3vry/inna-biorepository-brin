@extends('layouts.main')

@push('css')
<style>

img {
    max-width: 100%;
    height: auto;
}
</style>

@endpush

@section('container')
<div class="container mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item"><a class="text-brin" href="#">Manuals</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
        </ol>
    </div>
    <div class="col-lg-12">
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>
@endsection
