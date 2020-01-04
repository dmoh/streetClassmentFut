@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players ">
        <div class="container">
            <div class="row">
                <div class="header-hat"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 ">
                    @include('components.profile-card')
                </div>
                <div class="col-md-6 marg-top-fut-bg">
                    <div class="title-table">
                      <h6 class="text-center">STATISTIQUES</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span>NOTE GLOBALE</span></td>
                                    <td><span>85</span></td>
                                    <td><span>Forme Actuelle</span></td>
                                    <td style="text-align: center"><span><i class="fa fa-caret-up"></i></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="infos-player">
                        <table class="table">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        RANK
                                    </td>
                                    <td>1</td>
                                </tr>
                            <tr>
                                <td>
                                    AVERAGE
                                </td>
                                <td>8,5 / 10</td>
                            </tr>
                            <tr>
                                <td>
                                    POSITION
                                </td>
                                <td>Milieu défensif</td>
                            </tr>
                            <tr>
                                <td>
                                    BUTS
                                </td>
                                <td>123</td>
                            </tr>
                            <tr>
                                <td>
                                    Passes décisives
                                </td>
                                <td>342</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- Forme actuelle -->
                    <!-- Efficacité (rendement) -->
                    <div class="bg-hat marg-top-fut-bg">
                        <div class="position-num-hat">
                            <h6>CHAPEAU</h6>
                        </div>
                        <div class="num-hat">
                            <h6>1</h6>
                        </div>
                    </div>
                    <div class="rest-infos">
                        <h6 class="text-uppercase">Derniers matchs</h6>
                    </div>
                    <div class="match-played">
                        <span class="text-warning">N</span>
                        <span class="text-success">V</span>
                        <span class="text-danger">D</span>
                        <span class="text-warning">N</span>
                    </div>
                    <div class="info-sigle">
                        <p><span class="text-warning">N</span> Nul, <span class="text-success">V</span> Victoire,
                            <span class="text-danger">D</span> Défaite</p>
                    </div>
                    <div class="man-of-match">
                        <h5>Homme du match </h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <a style="margin-bottom: 2rem" href="{{ route('backend.showVote') }}" class="btn btn-block btn-success">Voter</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Area Chart -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Progression</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/Chart/chart-area.js') }}"></script>
    <script type="text/javascript">
        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    </script>
@endsection