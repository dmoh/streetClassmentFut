@extends('layouts.app')

@section('content')
    <div class="container ">
        @if($playersMatch->isEmpty())
            <div class="row">
                <div class="col-md-12">
                    <h5 style="margin-top: 3rem; color: #0b0956" class="text-center">AUCUN VOTE POUR LE MOMENT</h5>
                </div>
            </div>
        @else
            <div id="table-of-vote">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="margin-top: 3rem; color: #0b0956" class="text-center">Voter pour les derniers matchs joués! Sois réglo :)</h4>
                    </div>
                </div>
                @foreach($playersMatch as $player)
                    <table class="table table-vote">
                        <tbody>
                        <tr>
                            <td style="width: 20%">{{ $player->name }}</td>
                            <td>
                                @include('partials.note', ['playerId' => $player->id ])
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <input id="matchId" type="hidden" value="{{$player->match_id}}">
                @endforeach
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-md-4">
                        <button id="validate_vote" class="btn btn-success btn-block">
                            VALIDER
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
           $(document).on('click', '#validate_vote', function () {
               const notes = [];
               const matchId = $('#matchId').val();
               const selectId = $('select[id^="note_vote"]');
               const selec = selectId.length;
               selectId.each(function (item) {
                    const idPlayer = parseInt($(this)[0].id.split('note_vote_')[1]);
                    const note = parseInt($(this)[0].value);
                    if(idPlayer > 0 && 0 < note &&  note <= 10 ){
                        notes.push({
                            voteToPlayerId: idPlayer,
                            scoreAwarded: note
                        });
                    }
                });

               if(selec === notes.length){
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: '{{route("vote.save")}}',
                       type: "POST",
                       data: {matchId: matchId, notes: notes},
                       success: function(data){
                           $('#table-of-vote').empty().append(
                               '<div class="alert alert-success" role="alert">\n' +
                               '  Vote enregistré ! GOOD JOB \n' +
                               '</div>');
                       }
                   });
               }

           });
        });
    </script>
@endsection