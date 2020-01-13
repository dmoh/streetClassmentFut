@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-dark-fut">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">
                        MATCH {{  date('d/m/Y', strtotime($match->get('match_date')))}}
                    </h2>
                </div>
            </div>
            <div class="row">
                {{ var_dump($match) }}
                {{ var_dump($players) }}
                <div class="col-md-12">
                    <ul>
                        @foreach($players as $player)

                            {{ dd($player->chunk(5)) }}

                            <li>
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div id="player-name_{{$player->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $player->name }}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $player->name }}</div>
                                                <input type="hidden" id="playerId" value="{{ $player->id }}" >
                                                <input type="hidden" id="note_{{ $player->id }}" value="{{ $player->rating_before_update }}" >
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <table class="table table-responsive">
                        <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->overall_average }}</td>
                                    <td>CHAPEAU 1</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection