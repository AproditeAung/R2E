@extends('main')
@section('meta')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        .page-link{
            background-color: #494848 !important;
            border: 1px solid #303031 !important;
        }
    </style>
@endsection
@section('title') setting @endsection
@section('dashboard_active','active fw-bold')

@section('contant')


            <div class="col-md-8 my-md-5">
                <div class="card bg-transparent border-secondary">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6 fw-bold "> <i class="icofont icofont-chart-line-alt me-3 "></i>  Weekly Blog Views Graph </div>
                            <div class="align-self-end ">
                                <form action="{{ route('dashboard') }}" method="get">
                                    <input type="date" value="{{ request()->StartDate ?? now()->subDays(6)->format('Y-m-d') }}" class="form-control-sm form-control " name="StartDate" onchange="this.form.submit()">
                                </form>
                            </div>
                        </div>
                        <hr>
                        <canvas id="myChart" width="150" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-3  my-md-5 col-xl-4">
                <div class="card mb-3 bg-transparent border-secondary">
                    <div class="d-flex justify-content-between align-items-center card-body ">
                        <div class="widget-content-left">
                            <div class="fw-bolder">Viewers</div>
                            <div class="small">All time viewers</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="h2  "><span> {{ $widget['AllTimeViewers'] }} </span></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 bg-transparent border-secondary">
                    <div class="d-flex justify-content-between align-items-center card-body ">
                        <div class="widget-content-left">
                            <div class="fw-bolder">Blogs</div>
                            <div class="small">All time Blogs</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="h2  "><span> {{ $widget['TotalBLogs'] }} </span></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 bg-transparent border-secondary">
                    <div class="d-flex justify-content-between align-items-center card-body ">
                        <div class="widget-content-left">
                            <div class="fw-bolder">Contact</div>
                            <div class="small">All time Contact</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="h2  "><span> {{ $widget['Contacts'] }} </span></div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-12 mb-5   mt-4 ">
                <div class="card bg-transparent border-secondary">
                    <div class="card-body">
                        <div class="fw-bolder ">
                            <i class="icofont icofont-chart-line-alt me-3 "></i>
                            Monthly Blog Views Graph
                        </div>
                        <hr>
                        <canvas id="monthlyGraph" width="150" height="80"></canvas>
                    </div>
                </div>
            </div>



@endsection

@section('script')
    <script>
        // Swal.fire({
        //     position: 'top-end',
        //     icon: 'success',
        //     title: 'Your work has been saved',
        //     showConfirmButton: false,
        //     timer: 1500
        // })

        const data = @json($weeklyViewers);
        console.log(data.map(el=>el.date))
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(el=>el.date),
                datasets: [{
                    label: 'Blog Viewers Graph',
                    data: data.map(el=>el.viewers),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero : true,
                        grid: {
                            drawOnChartArea : true
                        }
                    },
                    x: {
                        beginAtZero : true,
                        grid: {
                            drawOnChartArea : true
                        }
                    }
                }
            }


        });

        const monthlyData = @json($monthlyViewers);
        const Monthlyctx = document.getElementById('monthlyGraph').getContext('2d');
        const MonthlyChart = new Chart(Monthlyctx, {
            type: 'line',
            data: {
                labels: monthlyData.map(el=>el.month),
                datasets: [{
                    label: 'Blog Viewers Graph',
                    data: monthlyData.map(el=>el.viewers),
                    fill: true,
                    borderColor: 'rgb(63,182,90)',
                    tension: 0
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero : true,
                        grid: {
                            drawOnChartArea : true
                        }
                    },
                    x: {
                        beginAtZero : true,
                        grid: {
                            drawOnChartArea : true
                        }
                    }
                }
            }


        });
    </script>



@endsection
