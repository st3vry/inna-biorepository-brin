@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome, {{ auth()->user()->name }}</h1>
</div>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
body{
    /* margin-top:20px; */
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

a {
  color: white;
}

a:hover {
  color: salmon;
} 

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
} 
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">BioProjects</h6>
                    <h2 class="text-right"><i data-feather="list" style="width:32px;height:32px;"class="f-left"></i><span>{{ $bioproject_pub_count }} Projects</span> </h2>
                    <p class="m-b-0">Published<span class="f-right">{{ $bioproject_count }} Projects</span> </p>
                    <a href="/dashboard/bioprojects" class="stretched-link">Bioprojects Page</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">BioSamples</h6>
                    <h2 class="text-right"><i data-feather="layers" style="width:32px;height:32px;"class="f-left"></i><span>{{ $biosample_pub_count }} Samples</span></h2>
                    <p class="m-b-0">Published<span class="f-right">{{ $biosample_count }} Samples</span></p>
                    <a href="/dashboard/biosamples" class="stretched-link">Biosamples Page</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">BioArchives</h6>
                    <h2 class="text-right"><i data-feather="hard-drive" style="width:32px;height:32px;"class="f-left"></i><span>{{ $bioarchive_pub_count }} Archives</span></h2>
                    <p class="m-b-0">Published<span class="f-right">{{ $bioarchive_pub_count }} Archives</span></p>
                    <a href="/dashboard/bioarchives" class="stretched-link">Bioarchives Page</a>
                </div>
            </div>
        </div>
        
	</div>
</div>
@endsection