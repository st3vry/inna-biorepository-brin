@extends('dashboard.layouts.main')

@push('css')
<style>
    .timeline {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline .timeline-item {
        position: relative;
    }

    .timeline .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline .timeline-item:after {
        background-color: hsl(0, 0%, 90%);
        left: -38px;
        border-radius: 50%;
        height: 11px;
        width: 11px;
        content: "";
    }
</style>
@endpush

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="/dissem/permission-approval/">Permission Approval</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$permissionRequest->accession}}</li>
    </ol>
</div>
<div class="row">
    <div class="table-responsive col-md-8">
        <table class="table table-striped table-sm">
            <tr>
                <th>ID</th>
                <td>{{ $permissionRequest->id }}</td>
            </tr>
            <tr>
                <th>User ID</th>
                <td>{{ $permissionRequest->user_id }}</td>
            </tr>
            <tr>
                <th>Bioarchive ID</th>
                <td>{{ $permissionRequest->bioarchive_id }}</td>
            </tr>
            <tr>
                <th>Bioarchive Accession</th>
                <td>{{ $permissionRequest->bioarchive_accession }}</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td>{{ $permissionRequest->reason }}</td>
            </tr>
            <tr>
                <th>Research Area</th>
                <td>{{ $permissionRequest->research_area }}</td>
            </tr>
            <tr>
                <th>Research Title</th>
                <td>{{ $permissionRequest->research_title }}</td>
            </tr>
            <tr>
                <th>Abstract</th>
                <td>{{ $permissionRequest->abstract }}</td>
            </tr>
            <tr>
                <th>Proof of Funding</th>
                <td>
                    @if($permissionRequest->proof_of_funding)
                        <a href="{{ asset($permissionRequest->proof_of_funding) }}" target="_blank">View Proof of Funding</a>
                    @else
                        Not available
                    @endif
                </td>
            </tr>
            <tr>
                <th>Letter of Agreement</th>
                <td>
                    @if($permissionRequest->letter_of_agreement)
                        <a href="{{ asset($permissionRequest->letter_of_agreement) }}" target="_blank">View Letter of Agreement</a>
                    @else
                        Not available
                    @endif
                </td>
            </tr>
            <tr>
                <th>Research Proposal</th>
                <td>
                    @if($permissionRequest->research_proposal)
                        <a href="{{ asset($permissionRequest->research_proposal) }}" target="_blank">View Research Proposal</a>
                    @else
                        Not available
                    @endif
                </td>
            </tr>
            <tr>
                <th>CV</th>
                <td>
                    @if($permissionRequest->cv)
                        <a href="{{ asset($permissionRequest->cv) }}" target="_blank">View CV</a>
                    @else
                        Not available
                    @endif
                </td>
            </tr>
            <tr>
                <th>Agreed</th>
                <td>{{ $permissionRequest->is_agreed ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Approved</th>
                <td>{{ $permissionRequest->is_approved ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Temporary URL</th>
                <td>{{ $permissionRequest->temporary_url ?? 'Not set' }}</td>
            </tr>
            <tr>
                <th>Temporary URL Expiration</th>
                <td>{{ $permissionRequest->temporary_url_expiration ?? 'Not set' }}</td>
            </tr>
            {{-- <tr>
                <th>Created At</th>
                <td>{{ $permissionRequest->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $permissionRequest->updated_at }}</td>
            </tr> --}}
            
        </table>
    </div>
    <div class="d-flex justify-content-start mt-3">
    <form action="{{ route('permission-approval.update', $permissionRequest->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="action" id="action">

        <button type="submit" class="btn btn-success me-2" onclick="document.getElementById('action').value = 'approve'">
            Approve
        </button>
        
        <button type="submit" class="btn btn-danger" onclick="document.getElementById('action').value = 'decline'">
            Decline
        </button>
    </form>
    </div>
</div>

@endsection