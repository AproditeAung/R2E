@extends('Backend.layout.app')
@section('title') Dashboard @endsection
@section('admin_home_active','mm-active')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit ">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Dashboard</div>
            </div>
        </div>
    </div>

    <div class="container p-0 my-5 ">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="p-3 ">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h6 fw-bold text-muted  mb-0 "> Weekly Blog Views Graph </div>
                            <div class="align-self-end ">
                                <form action="{{ route('home') }}" method="get">
                                    <input type="date" value="{{ request()->StartDate ?? now()->subDays(6)->format('Y-m-d') }}" class="form-control-sm form-control " name="StartDate" onchange="this.form.submit()">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="150" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Viewers</div>
                            <div class="widget-subheading">All time viewers</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span> {{ $widget['AllTimeViewers'] }} </span></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 widget-content  bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Blogs</div>
                            <div class="widget-subheading">All time Blogs</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span>{{ $widget['TotalBLogs'] }} </span></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 widget-content  bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Contact</div>
                            <div class="widget-subheading">All time Contact</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers "><span>{{ $widget['Contacts'] }} </span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 mt-4 ">
                <div class="card">
                    <div class="card-header">
                        Monthly Blog Views Graph
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyGraph" width="150" height="80"></canvas>
                    </div>
                </div>
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
                        fill: false,
                        borderColor: 'rgb(63,182,90)',
                        tension: 0
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero : true,
                            display : false,
                            grid: {
                                drawOnChartArea : true
                            }
                        },
                        x: {
                            beginAtZero : true,
                            display : false,
                            grid: {
                                drawOnChartArea : true,
                                borderColor: 'red'
                            }
                        }
                    }
                }


            });
    </script>



@endsection
