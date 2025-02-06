@extends('layouts.main')

@section('container')
<div class="container  mt-5 pt-5" style="min-height: 90vh">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-brin" href="/">Home</a></li>
            <li class="breadcrumb-item"><a class="text-brin" href="/biosamples">Biosample</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$biosample->accession}}</li>
        </ol>
    </div>
    <div class="table-responsive col-lg-12">
        <table class="table table-striped table-sm">
            <tr>
                <td class="col-sm-1">Title</td>
                <td class="col-sm-7">{{$biosample->title}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Organism</td>
                <td class="col-sm-7">{{$biosample->organism->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Sample Type</td>
                <td class="col-sm-7">{{$biosample->sampletype->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Description</td>
                <td class="col-sm-7">{{$biosample->description}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Sample Type</td>
                <td class="col-sm-7">{{$biosample->sampletype->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Sample Attribute</td>
                <td class="col-sm-7">
                    <div class="card shadow-sm mb-2">
                        <div class="card-body">
                            <table class="table table-striped table-sm">
                                @forelse ($sample_attr as $item)
                                    <tr>
                                         <td class="col-sm-3">{{$item->attributesample->attr_text}}</td>
                                        <td class="col-sm-3">{{$item->value}}</td>
                                    </tr>
                                @empty
                                None
                                @endforelse
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Center</td>
                <td class="col-sm-1">{{$biosample->center == null ? "N/A" : $biosample->center->name}}
                </td>
            </tr>
            <tr>
                <td class="col-sm-1">Lab</td>
                <td class="col-sm-7">{{$biosample->user->lab == null ? "N/A" :$biosample->user->lab->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Submitter</td>
                <td class="col-sm-7">{{$biosample->user->name}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Submitted at</td>
                <td class="col-sm-7">{{$biosample->created_at->format('d-m-Y')}}</td>
            </tr>
            <tr>
                <td class="col-sm-1">Published at</td>
                <td class="col-sm-7">{{$biosample->published_at === null ? 'None' : $biosample->published_at->format('d-m-Y')}}</td>
            </tr>

        </table>
    </div>
    <div class="col-lg-12">
        <h3 class="mb-4 text-center">Other Information</h3>
                    <div class="accordion" id="dataAccordion">
            @foreach($data as $section => $details)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapse{{ $loop->index }}">
                            {{ $section }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#dataAccordion">
                        <div class="accordion-body">
                            @if(is_array($details))
                                <ul class="list-group">
                                    @foreach($details as $key => $value)
                                        <li class="list-group-item">
                                            <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> 
                                            @if(is_array($value))
                                                <ul>
                                                    @foreach($value as $subKey => $subValue)
                                                        <li><strong>{{ ucfirst(str_replace('_', ' ', $subKey)) }}:</strong> 
                                                            @if(is_array($subValue))
                                                                <ul>
                                                                    @foreach($subValue as $innerKey => $innerValue)
                                                                        <li><strong>{{ ucfirst(str_replace('_', ' ', $innerKey)) }}:</strong> 
                                                                            @if(is_array($innerValue))
                                                                                <ul>
                                                                                    @foreach($innerValue as $subsubKey => $subsubValue)
                                                                                        <li><strong>{{ ucfirst(str_replace('_', ' ', $subsubKey)) }}:</strong> {{ is_string($subsubValue) ? $subsubValue : print_r($subsubValue, true) }}</li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @else
                                                                                {{ is_string($innerValue) ? $innerValue : print_r($innerValue, true) }}
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                {{ is_string($subValue) ? $subValue : print_r($subValue, true) }}
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ is_string($value) ? $value : print_r($value, true) }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                {{ is_string($details) ? $details : print_r($details, true) }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
