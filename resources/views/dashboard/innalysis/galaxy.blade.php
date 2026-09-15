@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Galaxy Workflows</h1>
    </div>
    <div class="col-lg-12" id="app">
        {{-- <workflows-grid></workflows-grid> --}}
        @foreach (array_chunk($workflows, 4) as $items3)
            <div class="row">
                @foreach ($items3 as $item)
                    <div class="col-sm-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of the card's content.</p>
                                <a href="#" class="card-link">Go Analyze</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
