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
                                    <td><span>{{implode(',',$player->statPlayer()->get()->pluck('current_rating')->toArray())}}</span></td>
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
                                        @lang('Classement')
                                    </td>
                                    <td>1</td>
                                </tr>
                            <tr>
                                <td>
                                    NOTE MOYENNE
                                </td>
                                <td>{{implode(',',$player->statPlayer()->get()->pluck('overall_average')->toArray())}} / 10</td>
                            </tr>
                            <tr>
                                <td>
                                    POSTE
                                </td>
                                <td>{{implode(',',$player->statPlayer()->get()->pluck('position')->toArray()) == null ? 'N/A' : implode(',',$player->statPlayer()->get()->pluck('position')->toArray()) }}</td>
                            </tr>
                            <tr>
                                <td>
                                    BUTS
                                </td>
                                <td>{{implode(',',$player->statPlayer()->get()->pluck('goals')->toArray())}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Passes décisives
                                </td>
                                <td>
                                    {{implode(',',$player->statPlayer()->get()->pluck('assists')->toArray())}}
                                </td>
                            </tr>
                                <tr>
                                <td>
                                    Pieds fort
                                </td>
                                <td>
                                    @if(implode(',',$player->statPlayer()->get()->pluck('strong_foot')->toArray()) == 'right')
                                        DROIT
                                    @else
                                        GAUCHE
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   POINT FORT
                                </td>
                                <td>
                                    {{implode(',',$player->statPlayer()->get()->pluck('skill')->toArray())}}
                                </td>
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
                            <h6>{{ $hat }}</h6>
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
                @hasrole('admin')
                    <div style="text-align:  center" class="col-md-12">
                        <a href="{{ route('edit-player', implode(',',$player->statPlayer()->get()->pluck('player_id')->toArray())) }}" class="btn btn-primary">EDITER CE PROFIL</a>
                    </div>
                @endhasrole
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="margin-top: 2rem; margin-bottom: 2rem" class="divider"></div>
                    <div  class="infos-player">
                        <h6 style="font-size: x-large; color: #fff; text-transform: uppercase" class="text-center ">Mes stats du dernier match</h6>
                        <input type="hidden" id="arrLabelCharJs" value="{{ implode(',', array_reverse($getLastRating->pluck('name')->toArray())) }}">
                        <input type="hidden" id="labelCharJs" value="{{ implode(',', array_reverse($getLastRating->pluck('assigned_rating')->toArray())) }}">
                        <div class="table-responsive">
                            <table class="table last-game">
                                <tbody>
                                <tr class="border-bottom-table">
                                    <!--<td class="text-center border-left-table border-right-table"><span class="text-success">Victoire</span></td>-->
                                    <td class="border-right-table text-center border-left-table">Date</td>
                                    @if($matchDateFormated == null )
                                        <td class="text-center border-right-table">
                                            PAS DE MATCH
                                        </td>
                                    @else
                                        <td class="text-center border-right-table">{{ $matchDateFormated }}</td>
                                    @endif
                                    <td class="text-center">Note moyenne reçue </td>
                                    <td class="border-right-table text-center border-left-table">{{ $lastRating[0] ?? 'N/N' }}</td>
                                    <td class="text-center">BUT(S) Marqué(s)</td>
                                    <td class="border-right-table text-center border-left-table">{{ $statsLastMatch[0]->goals ?? 'N/N' }}</td>
                                    <td class="text-center">Homme du match</td>
                                    <td class="border-right-table border-left-table text-center">Non</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <a style="margin-bottom: 2rem" href="{{ route('vote.index') }}" class="btn btn-block btn-success">Votes</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Area Chart -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Evolution en fonction de la note moyenne obtenue</h6>
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

        const arr = $('#arrLabelCharJs').val();
        const numChar = $('#labelCharJs').val();
        const arrChar = numChar.split(',');
        const label = arr.split(',');


        var ctx = document.getElementById("myAreaChart");
        //ctx.style.backgroundColor = "rgba(0,0,0, 0.3)";
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                 labels: label, // todo mettre les dates des matchs
                // labels: '', // todo mettre les dates des matchs
                datasets: [{
                    label: "Note du match",
                    lineTension: 0.3,
                    backgroundColor: "rgba(52, 144, 220, 1)",
                    borderColor: "rgba(52, 144, 220, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    //data: [0, 1, 4, 8, 4.6, 6.9, 8.9, 5, 3, 5, 7, 8.5], // todo mettre les notes dernières
                    data: arrChar, // todo mettre les notes dernières
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
                            /*maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + number_format(value);
                            }*/
                            beginAtZero: true,
                            steps: 1,
                            stepValue: 1,
                            max: 10

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
                    backgroundColor: "rgba(255,255,255)",
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
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

    </script>
@endsection