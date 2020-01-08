@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h4>Voter pour le dernier match joué ! Sois réglo :)</h4>
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
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
           $(document).on('click', '#validate_vote', function () {
               var notes = [];
               var selec = $('select[id^="note_vote"]').length;
                $('select[id^="note_vote"]').each(function (item) {
                    var idPlayer = parseInt($(this)[0].id.split('note_vote_')[1]);
                    var note = parseInt($(this)[0].value);
                    if(idPlayer > 0 && 0 < note &&  note <= 10 ){
                        notes.push({
                            voteToPlayerId: idPlayer,
                            scoreAwarded: note
                        });
                    }

                });

           });
        });
    </script>
@endsection