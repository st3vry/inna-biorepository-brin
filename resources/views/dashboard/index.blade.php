@extends('dashboard.layouts.main')
@section('title', "Welcome, " . (str_word_count(auth()->user()->name) > 1 ? explode(' ', trim(auth()->user()->name))[0] . ' ' . last(explode(' ', trim(auth()->user()->name))) : auth()->user()->name) . "!")

@section('container')
<div class="row">
    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget-first">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary-subtle p-2 me-2">
                            <iconify-icon icon="tabler:list" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/bioprojects">BioProjects</a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioproject_pub_count }} of {{ $bioproject_count }} <small class="fs-12">Projects Published</small></h3>
                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-2 badge fs-12 {{$bioproject_count > 0 && number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $bioproject_count > 0 ? number_format(($bioproject_pub_count / $bioproject_count) * 100, 2) : 0 }}%
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                        <p class="mb-0 text-muted">{{ $bioproject_hold_count }} Bioprojects on Hold</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget-first">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-danger-subtle p-2 me-2">
                            <iconify-icon icon="tabler:layers-subtract" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/biosamples">BioSamples</a>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $biosample_pub_count }} of {{ $biosample_count }} <small class="fs-12">Samples Published</small></h3>

                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-2 badge fs-12 {{$biosample_count > 0 && number_format(($biosample_pub_count / $biosample_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $biosample_count > 0 ? number_format(($biosample_pub_count / $biosample_count) * 100, 2) : 0 }}%
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                        <p class="mb-0 text-muted">{{ $biosample_hold_count }} Biosamples on Hold</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget-first">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-success-subtle p-2 me-2">
                            <iconify-icon icon="tabler:server" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <a class="mb-0 text-dark fs-16 stretched-link" href="/dashboard/bioarchives">BioArchives</a>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{ $bioarchive_pub_count }} of {{ $bioarchive_count }} <small class="fs-12">Archives Published</small></h3>

                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-2 badge fs-12 {{$bioarchive_count > 0 && number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ $bioarchive_count > 0 ? number_format(($bioarchive_pub_count / $bioarchive_count) * 100, 2) : 0 }}%
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                        <p class="mb-0 text-muted">{{ $bioarchive_hold_count }} BioArchives on Hold</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="widget-first">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-info-subtle p-2 me-2">
                            <iconify-icon icon="tabler:circle-check" class="align-middle text-dark fs-26 mb-0"></iconify-icon>
                        </div>
                        <p class="mb-0 text-dark fs-16">Total Published</p>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="fs-24 fw-medium text-dark mb-0 me-3">{{$bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count}} of {{$bioproject_count + $biosample_count + $bioarchive_count}} <small class="fs-12">Published</small></h3>
                        
                        <div class="d-flex align-items-center">
                            <span class="me-2 rounded-2 badge fs-12 {{ ($bioproject_count + $biosample_count + $bioarchive_count) > 0 && number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) > 50 ? 'badge-soft-success' : 'badge-soft-danger'}} fw-medium">{{ ($bioproject_count + $biosample_count + $bioarchive_count) > 0 ? number_format((($bioproject_pub_count + $biosample_pub_count + $bioarchive_pub_count) / ($bioproject_count + $biosample_count + $bioarchive_count)) * 100, 2) : 0 }}%
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-0 pt-3 border-top border-dashed">
                        <p class="mb-0 text-muted">{{$bioproject_hold_count + $biosample_hold_count + $bioarchive_hold_count}} Total on Hold</p>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- start row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="card-title text-dark mb-0">Overview</h5>
                    <div class="ms-auto"> 
                        <select class="form-select form-select-sm bg-light text-muted border" id="overviewYearSelect" onchange="updateOverviewChart([this.value])">
                            <option value="0" selected>All Time</option>
                            @for ($i = date('Y'); $i >= 2022; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row col-12">
                    <div class="col-md-12 col-xl-9">
                        <div class="p-2">
                            <div id="overview" class="apex-charts"></div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-3 col-md-6">
                                <div class="card mb-lg-0">
                                    <div class="card-body p-2 bg-primary-subtle">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="p-2 rounded-2">
                                                <iconify-icon icon="tabler:list" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="text-dark fs-14 mb-1">Bioproject</h5>
                                                <h6 class="text-muted fw-medium mb-0 fs-16" id="bioprojectByYear">{!! array_sum($bioproject_overview) !!}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card mb-lg-0">
                                    <div class="card-body p-2 bg-danger-subtle">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="p-2 rounded-2">
                                                <iconify-icon icon="tabler:layers-subtract" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="text-dark fs-14 mb-1">Biosample</h5>
                                                <h6 class="text-muted fw-medium mb-0 fs-16" id="biosampleByYear">{!! array_sum($biosample_overview) !!}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card mb-lg-0">
                                    <div class="card-body p-2 bg-success-subtle">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="p-2 rounded-2">
                                                <iconify-icon icon="tabler:server" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="text-dark fs-14 mb-1">Bioarchive</h5>
                                                <h6 class="text-muted fw-medium mb-0 fs-16" id="bioarchiveByYear">{!! array_sum($bioarchive_overview) !!}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <div class="card mb-lg-0">
                                    <div class="card-body p-2 bg-info-subtle">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="p-2 rounded-2">
                                                <iconify-icon icon="tabler:circle-check" class="align-middle text-primary fs-26 mb-0"></iconify-icon>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="text-dark fs-14 mb-1">Total</h5>
                                                <h6 class="text-muted fw-medium mb-0 fs-16" id="totalByYear">{!! array_sum($total_overview) !!}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-3 mt-4">
                        <div id="leadChart" class="apex-charts"></div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                    <div>
                                        <i class="mdi mdi-circle fs-13 align-middle me-1" style="color: #1627a7;"></i>,
                                        <span class="align-middle fs-13 fw-semibold">BioProjects</span>
                                    </div>
                                    <span class="fw-semibold text-muted float-end fs-13" id="bioprojectPercentage">{{ $bioproject_count > 0 ? number_format(($bioproject_count) / ($bioproject_count + $biosample_count + $bioarchive_count) * 100, 2) : 0 }}%</span>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                    <div>
                                        <i class="mdi mdi-circle fs-13 align-middle me-1" style="color: #F04B6A;"></i>
                                        <span class="align-middle fs-13 fw-semibold">BioSamples</span>
                                    </div>
                                    <span class="fw-semibold text-muted float-end fs-13" id="biosamplePercentage">{{ $biosample_count > 0 ? number_format(($biosample_count) / ($bioproject_count + $biosample_count + $bioarchive_count) * 100, 2) : 0 }}%</span>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="d-flex justify-content-between align-items-center p-1 border border-dashed rounded-2">
                                    <div>
                                        <i class="mdi mdi-circle fs-13 align-middle me-1" style="color: #29B95F;"></i>
                                        <span class="align-middle fs-13 fw-semibold">BioArchives</span>
                                    </div>
                                    <span class="fw-semibold text-muted float-end fs-13" id="bioarchivePercentage">{{ $bioarchive_count > 0 ? number_format(($bioarchive_count) / ($bioproject_count + $biosample_count + $bioarchive_count) * 100, 2) : 0 }}%</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end start -->
@endsection

@push('js')

<script src="/libs/apexcharts/apexcharts.min.js"></script>
<script>
    
    // Overview Chart
    function updateOverviewChart(year) {
        console.log(year);
        fetch('/dashboard/overview-chart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ year: year })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            console.log ({!!  json_encode($total_overview)  !!})
            overviewChart.updateOptions({
                series: [
                    {
                        name: "BioProjects",
                        data: data.bioproject,
                        type: "bar"
                    },
                    {
                        name: "BioSamples",
                        data: data.biosample,
                        type: "bar"
                    },
                    {
                        name: "BioArchives",
                        data: data.bioarchive,
                        type: "bar"
                    },
                    {
                        name: "Total",
                        data: data.total,
                        type: "area"
                    },
                ]
            });

            leadChart.updateOptions({
                series: [data.bioproject.reduce((a, b) => a + b, 0), data.biosample.reduce((a, b) => a + b, 0), data.bioarchive.reduce((a, b) => a + b, 0)],
            });
            bioprojectByYear.textContent = data.bioproject.reduce((a, b) => a + b, 0);
            biosampleByYear.textContent = data.biosample.reduce((a, b) => a + b, 0);
            bioarchiveByYear.textContent = data.bioarchive.reduce((a, b) => a + b, 0);
            totalByYear.textContent = data.total.reduce((a, b) => a + b, 0);
            bioprojectPercentage.textContent = data.bioproject.reduce((a, b) => a + b, 0) > 0 ? ((data.bioproject.reduce((a, b) => a + b, 0) / (data.bioproject.reduce((a, b) => a + b, 0) + data.biosample.reduce((a, b) => a + b, 0) + data.bioarchive.reduce((a, b) => a + b, 0))) * 100).toFixed(2) + '%' : '0%';
            biosamplePercentage.textContent = data.biosample.reduce((a, b) => a + b, 0) > 0 ? ((data.biosample.reduce((a, b) => a + b, 0) / (data.bioproject.reduce((a, b) => a + b, 0) + data.biosample.reduce((a, b) => a + b, 0) + data.bioarchive.reduce((a, b) => a + b, 0))) * 100).toFixed(2) + '%' : '0%';
            bioarchivePercentage.textContent = data.bioarchive.reduce((a, b) => a + b, 0) > 0 ? ((data.bioarchive.reduce((a, b) => a + b, 0) / (data.bioproject.reduce((a, b) => a + b, 0) + data.biosample.reduce((a, b) => a + b, 0) + data.bioarchive.reduce((a, b) => a + b, 0))) * 100).toFixed(2) + '%' : '0%';
        })
        .catch(error => console.error('Error fetching overview chart data:', error));
    }
    const overviewOptions = {
        series: [
            {
                name: "BioProjects",
                data: {!! json_encode($bioproject_overview) !!},
                type: "bar"
            },
            {
                name: "BioSamples",
                data: {!! json_encode($biosample_overview) !!},
                type: "bar"
            },
            {
                name: "BioArchives",
                data: {!! json_encode($bioarchive_overview) !!},
                type: "bar"
            },
            {
                name: "Total",
                data: {!! json_encode($total_overview) !!},
                type: "area"
            },
        ],
        chart: {
            height: 320,
            type: "bar",
            toolbar: { show: false },
            parentHeightOffset: 0
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: '50%',
                barHeight: "70%",
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            opacity: [1, 1, 1, .3],
            type: ["gradient", "gradient", "gradient", "solid"],
            colors: ['#1627a7', '#F04B6A', '#29B95F', '#13B4E6'],
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#1627a7', '#F04B6A',  '#29B95F', '#13B4E6'],
                inverseColors: false,
                opacityTo: [.05, .05, 1],
                stops: [0, 100],
            },
        },
        grid: {
            show: true,
            borderColor: "#D1D5DB",
            strokeDashArray: 4,
            position: 'back',
        },
        xaxis: {
            type: 'category',
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        tooltip: {
            shared: true,
            intersect: false,
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            markers: {
                fillColors: ['#1627a7', '#F04B6A',  '#29B95F', '#13B4E6']
            }
        }
    };
    const overviewChart = new ApexCharts(document.querySelector("#overview"), overviewOptions);
    overviewChart.render();


    // Sales Pipeline Chart
    const leadChartOptions = {
        series: [{{$bioproject_count}}, {{$biosample_count}}, {{$bioarchive_count}}],
        chart: {
            type: 'donut',
            height: 270,
        },
        labels: ['BioProjects', 'BioSamples', 'BioArchives'],
        colors: ['#1627a7', '#F04B6A',  '#29B95F'],
        stroke: {
            width: 0,
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '14px',
                            color: '#008080',
                            offsetY: -10
                        },
                        value: {
                            show: true,
                            fontSize: '20px',
                            fontWeight: 600,
                            color: '#008080',
                            offsetY: 10,
                            formatter: (val) => (val / ({{ $bioproject_count + $biosample_count + $bioarchive_count }}) * 100).toFixed(2) + "%"
                        },
                        total: {
                            show: true,
                            label: 'Contribution',
                            fontSize: '14px',
                            fontWeight: 500,
                            color: '#008080',
                            formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                        }
                    }
                },
                expandOnClick: false,
                customScale: 1,
                offsetY: 0
            }
        },
    };
    const leadChart = new ApexCharts(document.querySelector("#leadChart"), leadChartOptions);
    leadChart.render();

    const bioprojectByYear = document.getElementById('bioprojectByYear');
    const biosampleByYear = document.getElementById('biosampleByYear');
    const bioarchiveByYear = document.getElementById('bioarchiveByYear');
    const totalByYear = document.getElementById('totalByYear');
    const bioprojectPercentage = document.getElementById('bioprojectPercentage');
    const biosamplePercentage = document.getElementById('biosamplePercentage');
    const bioarchivePercentage = document.getElementById('bioarchivePercentage');

    </script>
    @endpush