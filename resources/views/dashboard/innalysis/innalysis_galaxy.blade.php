@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Galaxy Workflows</h1>
</div>

<div class="col-lg-12" id="app">
{{-- {{ dd($workflows) }} --}}
{{-- <workflows-grid></workflows-grid> --}}
{{-- test --}}
 <form method="POST" action="{{ route('send.workflow') }}">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Galaxy Workflows</label>
        <select class="form-select" name="workflow" aria-label="Default select example">
            <option selected>Choose workflows</option>
            @foreach ($workflows as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option> 
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Input 1</label>
        <input type="input1" name="input1" class="form-control" id="exampleFormControlInput1" placeholder="File 1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Input 2</label>
        <input type="input2" name="input2" class="form-control" id="exampleFormControlInput2" placeholder="File 2">
    </div>
    
    <button type="submit" class="btn btn-primary">Proceed</button>
</form> 
</div>
@endsection