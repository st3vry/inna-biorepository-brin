@extends('layouts.main')

@section('container')
<h1>Index of Folder: {{ $currentFolder }}</h1>

    {{-- Breadcrumb Navigation --}}
    <nav>
        <ol class="breadcrumb">
            @php
                $paths = explode('/', $currentFolder);
                $accumulatedPath = '';
            @endphp
            @foreach ($paths as $index => $path)
                @php $accumulatedPath .= $index === 0 ? $path : '/' . $path; @endphp
                <li class="breadcrumb-item">
                    <a href="{{ route('folder.index', ['relativePath' => $accumulatedPath]) }}">{{ $path }}</a>
                </li>
            @endforeach
        </ol>
    </nav>

    {{-- Subfolders --}}
    <h3>Folders</h3>
    <ul class="list-group mb-3">
        @forelse ($folders as $folder)
            <li class="list-group-item">
                <a href="{{ $folder['url'] }}">{{ $folder['name'] }}</a>
            </li>
        @empty
            <li class="list-group-item">No folders found.</li>
        @endforelse
    </ul>

    {{-- Files --}}
    <h3>Files</h3>
    <ul class="list-group">
        @forelse ($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $file['name'] }}</span>
                <a href="{{ $file['url'] }}" class="btn btn-primary btn-sm" download>Download</a>
            </li>
        @empty
            <li class="list-group-item">No files found.</li>
        @endforelse
    </ul>
@endsection