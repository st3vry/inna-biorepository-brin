@extends('layouts.main')
@section('container')
<div class="container  mt-5 pt-5" style="min-height: 90vh">
    <div class="row">
        <div class="col-12 text-center">
            <lottie-player class="mx-auto" src="/images/ud.json" background="transparent" speed="1", style="height:70vh" loop autoplay> </lottie-player>
            <div class="display-3"> Feature under development!</div>
            <button class="btn btn-danger btn-sm" onclick="history.back()">Go Back</button>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
