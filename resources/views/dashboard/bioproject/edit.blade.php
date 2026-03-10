@extends('dashboard.layouts.main')
@section('title', 'Edit Bioproject ' . $bioproject->accession)
@section('container')
@livewire('edit-bioproject',['bioproject' => $bioproject])
@endsection