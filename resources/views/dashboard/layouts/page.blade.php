@extends('dashboard.layouts.main')
@section('title', 'Sample Page')

@push('css')
@endpush


@section('container')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                Some Header Here
            </div>

            <div class="card-body">
                Sample page
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
