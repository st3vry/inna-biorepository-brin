@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Edit Bioarchive</h1>
</div>
<div class="col-lg-12">
    @livewire('edit-bioarchive', ['accession' => $bioarchive->accession])
</div>
@endsection
