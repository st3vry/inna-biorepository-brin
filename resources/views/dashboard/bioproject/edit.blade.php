@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Edit Bioproject Data</h1>
</div>
<div class="col-lg-10">
    @livewire('edit-bioproject',['bioproject' => $bioproject])

</div>
@endsection