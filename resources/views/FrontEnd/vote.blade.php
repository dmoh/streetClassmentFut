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
                        <h4 style="margin-top: 3rem; color: #0b0956" class="text-center">Vote pour le dernier match joué! Sois réglo :)</h4>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-vote">
                        <tbody>
                        @foreach($playersMatch as $player)
                            <tr>
                                <td style="width: 10%">{{ $player->name }}</td>
                                <td>
                                @include('partials.note', ['playerId' => $player->id ])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <input id="matchId" type="hidden" value="{{$player->match_id}}">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label  style="color: #1b1e21; font-family: Anton, sans-serif"  for="manOfMatch">Homme du match</label>
                            <select class="form-control" name="manOfMatch" id="manOfMatch">
                                <option value="null">Homme du match</option>
                                @foreach($playersMatch as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label  style="color: #1b1e21; font-family: Anton, sans-serif"  for="mentionSpecial">Mention Spéciale</label>
                            <select class="form-control" name="mentionSpecial" id="mentionSpecial">
                                <option value="null">Mention Spéciale</option>
                                @foreach($mentions as $mention)
                                    <option value="{{ $mention }}">{{ strtoupper($mention)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label style="color: #1b1e21; font-family: Anton, sans-serif" for="playerMentionSpecial">JOUEUR</label>
                            <select class="form-control" name="playerMentionSpecial" id="playerMentionSpecial">
                                <option value="null">Joueur</option>
                                @foreach($playersMatch as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
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
            //todo disabled joueur qui a zero pour homme du match et mention spé
           $(document).on('click', '#validate_vote', function () {
               if(confirm('JE VALIDE MON VOTE ?')){
                   const notes = [];
                   const matchId = $('#matchId').val();
                   const selectId = $('select[id^="note_vote"]');
                   const selec = selectId.length;
                   const mentionSpec = $(`#mentionSpecial`).val();
                   const playerMentionSpec = $(`#playerMentionSpecial`).val();
                   const manOfMatch = $(`#manOfMatch`).val();

                   selectId.each(function (item) {
                       const idPlayer = parseInt($(this)[0].id.split('note_vote_')[1]);
                       const note = $(this)[0].value.trim() === 'no_rating' ? 'no_rating' : parseInt($(this)[0].value);
                       if(note !== 'no_rating'){
                           if(idPlayer > 0 && 0 < note &&  note <= 10 ){
                               let hdm = '0';
                               if(idPlayer === parseInt(manOfMatch)){
                                   hdm = '1';
                               }
                               let specialMention = null;
                               if(parseInt(playerMentionSpec) === idPlayer && mentionSpec !== 'null'){
                                    specialMention = mentionSpec;
                               }

                               notes.push({
                                   voteToPlayerId: idPlayer,
                                   scoreAwarded: note,
                                   hdm: hdm,
                                   specialMention: specialMention
                               });
                           }
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
                               if(data.error){
                                   $('#table-of-vote').empty().append(
                                       '<div class="alert alert-danger" role="alert">\n' +
                                       data.error+
                                       '</div>');
                               }else {
                                   $('#table-of-vote').empty().append(
                                       '<div class="alert alert-success" role="alert">\n' +
                                       '  Vote enregistré ! GOOD JOB \n' +
                                       '</div>'
                                   );
                               }

                           }
                       });
                   }
               }
           });
        });
    </script>
@endsection