@extends('layouts.main')

@section('container')
<div class="container  mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item"><a class="text-brin" href="/bioarchives">Bioarchive</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$bioarchive_accession}}</li>
        </ol>
    </div>
    <h1 class="text-center mb-4">Request a Permission</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('permission_request.store') }}" method="POST" class="border p-4 bg-light rounded" enctype="multipart/form-data">
            @csrf

            <!-- Hidden Fields for user_id and bioarchive_id -->
            <input type="hidden" name="user_id" value="{{ old('user_id', $user_id) }}">
            <input type="hidden" name="bioarchive_id" value="{{ old('bioarchive_id', $bioarchive_id) }}">
            <input type="hidden" name="bioarchive_accession" value="{{ old('bioarchive_accession', $bioarchive_accession) }}">
            <!-- Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $username) }}" disabled required>
            </div>

            <div class="mb-3">
                <label for="_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="_name" id="_name" value="{{ old('_name', $_name) }}" disabled required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $email)}}" disabled required>
            </div>

            <!-- Reason -->
            <div class="mb-3">
                <label for="reason" class="form-label">Reason for Request</label>
                <textarea name="reason" id="reason" rows="4" class="form-control" required>{{ old('reason') }}</textarea>
            </div>
            <!-- Research Fields -->
            <div class="mb-3">
                <label for="research_area" class="form-label">Research Area</label>
                <input type="text" class="form-control" name="research_area" id="research_area" value="{{ old('research_area') }}" required>
            </div>
            <div class="mb-3">
                <label for="research_title" class="form-label">Research Title</label>
                <input type="text" class="form-control" name="research_title" id="research_title" value="{{ old('research_title') }}" required>
            </div>
            <div class="mb-3">
                <label for="abstract" class="form-label">Abstract Research Proposal</label>
                <textarea name="abstract" id="abstract" rows="4" class="form-control" required>{{ old('abstract') }}</textarea>
            </div>
            <!-- File Uploads -->
            <div class="mb-3">
                <label for="proof_of_funding" class="form-label">Proof of Research Funding</label>
                <input type="file" class="form-control" name="proof_of_funding" id="proof_of_funding" accept="application/pdf" required>
            </div>
            <div class="mb-3">
                <label for="letter_of_agreement" class="form-label">Letter of Agreement</label>
                <input type="file" class="form-control" name="letter_of_agreement" id="letter_of_agreement" accept="application/pdf" required>
            </div>
            <div class="mb-3">
                <label for="research_proposal" class="form-label">Research Proposal (Short Version)</label>
                <input type="file" class="form-control" name="research_proposal" id="research_proposal" accept="application/pdf" required>
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">Curriculum Vitae (CV)</label>
                <input type="file" class="form-control" name="cv" id="cv" accept="application/pdf" required>
            </div>

            
            <!-- Permission -->
            {{-- <div class="mb-3">
                <label for="permission" class="form-label">Permission Requested</label>
                <select name="permission" id="permission" class="form-select" required>
                    <option value="admin" {{ old('permission') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ old('permission') == 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="viewer" {{ old('permission') == 'viewer' ? 'selected' : '' }}>Viewer</option>
                </select>
            </div> --}}

            <!-- Reason -->
            {{-- <div class="mb-3">
                <label for="reason" class="form-label">Reason for Request</label>
                <textarea name="reason" id="reason" rows="4" class="form-control" required>{{ old('reason') }}</textarea>
            </div> --}}

            {{-- AGREEMENT --}}
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_agreed" class="form-check-input @error('is_agreed') is-invalid @enderror" id="is_agreed" value="1">
                    <label class="form-check-label" for="is_agreed">I agree to the terms and conditions</label>
                </div>
                @error('is_agreed')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>
        </form>

</div>
@endsection
