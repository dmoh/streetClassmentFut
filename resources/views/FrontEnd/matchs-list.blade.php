@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <h2 style="    padding: 2rem;background: #cccccc63;color: #fff;font-family: Oswald, sans-serif;font-size: xx-large;" class="text-center text-uppercase"> Liste des matchs</h2>
        <div class="container">
            @foreach($matchs as $match)
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading{{ $match->id }}">
                                    <h5 class="mb-0 text-center">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $match->id }}" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="text-center">MATCH DU  <b>{{ date('d/m/Y', strtotime($match->match_date))}}</b>, SCORE  {{ $match->score }}</h4>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse{{ $match->id }}" class="collapse @if ($loop->first)show @endif" aria-labelledby="heading{{ $match->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th>
                                                        JOUEURS
                                                    </th>
                                                    <th>Buts</th>
                                                    <th>PaD</th>
                                                    <th>Notes</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($playersMatch as $player)
                                                        @if($player->id === $match->id)
                                                            <tr>
                                                                <td>{{ $player->name }}, {{ $player->surname }}</td>
                                                                <td>{{ $player->goals }}</td>
                                                                <td>{{ $player->goals }}</td>
                                                                <td>{{ $player->goals }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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