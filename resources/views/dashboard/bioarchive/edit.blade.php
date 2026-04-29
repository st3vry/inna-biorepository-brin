@extends('dashboard.layouts.main')
@section('title', 'Edit Bioarchive')
@section('container')
@livewire('edit-bioarchive', ['accession' => $bioarchive->accession])
@endsection
