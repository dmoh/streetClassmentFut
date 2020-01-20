@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <h2 style="    padding: 2rem;background: #cccccc63;color: #fff;font-family: Oswald, sans-serif;font-size: xx-large;" class="text-center text-uppercase"> Liste des matchs</h2>
        @foreach($matchs as $match)
            <div class="row">
                <div class="col">
                    <h4>MATCH DU  <b>{{ date('d/m/Y', strtotime($match->match_date))}}</b></h4>
                </div>
                <div class="col">SCORE  {{ $match->score }}</div>
                <span id="matchId_{{ $match->id }}" style="display: none !important;">{{ $match->id }}</span>
                <span id="showListPlayers"><a href="" data-toggle="collapse" data-target="#listPlayer_{{ $match->id }}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-caret-right"></i></a> </span>
            </div>
            <div class="row">
                @foreach($playersMatch as $player)
                    <div class="col">
                        @if($player->id === $match->id)
                            <span style="color: #fff">
                                {{ $player->name }}, {{ $player->surname }}
                            </span>
                            <span>
                                {{ $player->goals }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', '#showListPlayers', function () {

            });
        });
    </script>
@endsection