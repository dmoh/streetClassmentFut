@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <h2 style="    padding: 2rem;background: #cccccc63;color: #fff;font-family: Oswald, sans-serif;font-size: xx-large;" class="text-center text-uppercase"> Liste des matchs</h2>
        @foreach($matchs as $match)
            <table style="background: #ffffffe3;" class="table ">
                <tbody>
                    <tr>
                        <td>DATE </td>
                        <td>{{ date('d/m/Y', strtotime($match->match_date))}}</td>
                        <td>SCORE</td>
                        <td>{{ $match->score }}</td>
                        <td>{{ $match->id }}</td>
                        <td id="showListPlayers"><a href="" data-toggle="collapse" data-target="#listPlayer_{{ $match->id }}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-caret-right"></i></a></td>
                    </tr>
                    <table class="collapse table" id="listPlayer_{{ $match->id }}">
                        <tbody>
                        @foreach($playersMatch as $player)
                                @if($player->id === $match->id)
                                    <tr>
                                        <td>{{ $player->name }}</td>
                                        <td>{{ $player->surname }}</td>
                                        <td>{{ $player->goals }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </tbody>
            </table>
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