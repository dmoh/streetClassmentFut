@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-list-players">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 id="title-top-match" class="text-center ">
                        MATCH DU {{  date('d/m/Y', strtotime(implode(',', $match->pluck('match_date')->toArray())))}}
                    </h2>
                    <input type="hidden" id="matchId" value="{{implode(',',$match->pluck('id')->toArray())}}">
                </div>
            </div>
            <div class="wrapper-score">
                <h3 class="text-center" id="score-match">SCORE</h3>
                <div class="row">
                    <div style="text-align: right; font-size: x-large" class="col-md-5">
                        <label for="score-team_1">TEAM 1</label>
                        <input type="number" class="form-control" name="score-team_1" id="score-team_1">
                    </div>
                    <div style="text-align: center" class="col-md-2">
                        <span id="versus-team">VS</span>
                    </div>
                    <div style=" font-size: x-large" class="col-md-5">
                        <label for="score-team_2">TEAM 2</label>
                        <input type="number" class="form-control" name="score-team_2" id="score-team_2">
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($players->chunk(5) as $chunk)
                    <div class="col-md-6">
                        @foreach($chunk as $player)
                            <ul style="padding-left: 0; ">
                                <li>
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div style="padding-top: 0.4rem; padding-bottom: 0rem" class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2 alignement-flex">
                                                    <div class="img-small-left">
                                                        <div class="info-note-player">
                                                           {{$player->current_rating}}
                                                        </div>
                                                        <div class="info-poste-player">
                                                            {{$player->position}}
                                                        </div>
                                                    </div>
                                                    <div id="align-col">
                                                        <div style="font-size: x-large" id="player-name_{{$player->id}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ $player->name }}</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                                        <div style="display: flex" class="stats-player">
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>VIT</div>
                                                                <div>{{$player->pace == null  ? '00' : $player->pace }}</div>
                                                            </div>
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>TIR</div>
                                                                <div>{{$player->shoot == null  ? '00' : $player->shoot }}</div>
                                                            </div>
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>PAS</div>
                                                                <div>{{$player->passe == null  ? '00' : $player->passe }}</div>
                                                            </div>
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>DRI</div>
                                                                <div>{{ $player->dribble  == null  ? '00' : $player->dribble  }}</div>
                                                            </div>
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>DEF</div>
                                                                <div>{{$player->defense == null  ? '00' : $player->defense }}</div>
                                                            </div>
                                                            <div  class="couple-stat-note margin-right-6">
                                                                <div>PHY</div>
                                                                <div>{{$player->physique == null  ? '00' : $player->physique   }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="playerId" value="{{ $player->id }}" >
                                                    <input type="hidden" id="note_{{ $player->id }}" value="{{ $player->rating_before_update }}" >
                                                </div>
                                                <div style="display: flex" class="col-auto">
                                                    <div style="z-index: 1000"><span>CHAPEAU</span>
                                                        <div style="text-align: center; font-size: xx-large; color: #3490dc">1</div>
                                                    </div>
                                                    <div style="position: absolute;margin-top: 3rem;margin-left: -5px;">
                                                        <i class="fas fa-trophy fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="justify-content: space-around; margin-top: 0.5rem" class="row">
                                                <div style="display: inline-flex; justify-content: space-evenly; align-items: flex-end;">
                                                    <div class="col mr-2 alignement-flex">
                                                        <span class="font-weight-bold">BUT </span><input type="number"  class="form-control" id="but_{{$player->id}}" value="0">
                                                    </div>

                                                    <div class="col alignement-flex">
                                                        <span class="font-weight-bold">Pa.D</span><input type="number"  class="form-control" id="passe-d_{{$player->id}}" value="0">
                                                    </div>
                                                    <div class="col alignement-flex">
                                                        <span class="font-weight-bold">HdM</span>
                                                        <input type="radio" name="hdm" class="form-control"  id="hdm_{{$player->id}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div style="    flex-direction: column; padding-top: 0.2rem;" class="col alignement-flex">
                                                    <p style="font-size: small"><em>Pa.D: Passe decisive, Hdm: homme du match</em></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                @endforeach

                </div>
            <div class="row">
                <div style="justify-content: center; font-size: xx-large" class="col alignement-flex">
                    <button type="button" id="btn-validate-score" style="text-transform: uppercase;    font-size: x-large;" class="btn btn-primary">ENREGISTRER LES Résultats</button>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(function () {
            $(document).on('click', '#btn-validate-score', function () {
                if(confirm('Valider les informations du match ?')){
                    const scoreTeam1 = parseInt($('#score-team_1').val());
                    const scoreTeam2 = parseInt($('#score-team_2').val());
                    //user_id => buts, pass, hdm: true;
                    let usersInfo = [];

                    if(scoreTeam1 === 0 || scoreTeam1 === null || scoreTeam1 === '' || isNaN(scoreTeam1) ){
                        alert('SCORE INCOMPLET');
                        return false;
                    } else if(scoreTeam2 === 0 || scoreTeam2 === null || scoreTeam2 === '' || isNaN(scoreTeam2) ){
                        alert('SCORE INCOMPLET');
                        return false;
                    }else{
                        let scores = {
                            scoreTeam1: scoreTeam1,
                            scoreTeam2: scoreTeam2,
                        };
                        usersInfo.push(scores);
                    }
                    // BUTS PASSE D PAR TETE
                    $('input[id^="but_"]').each(function(elem)  {
                        const userIdCurrent = parseInt($(this).attr('id').split('_')[1]);
                        const goalsUserCurrent = $(`#but_${userIdCurrent}`).val();
                        const assistsUserCurrent = $(`#passe-d_${userIdCurrent}`).val();
                        let hdm = false;
                        if( $(`#hdm_${userIdCurrent}`).is(':checked'))
                        {
                            hdm = true;
                        }

                        const user = {
                            userId: userIdCurrent,
                            goals: goalsUserCurrent,
                            assists: assistsUserCurrent,
                            hdm: hdm,
                        };
                        usersInfo.push(user);
                    });

                    // todo LOCKED MAtch to edit

                    const matchId = $('#matchId').val();

                    $.ajax({
                       url: "{{ route('resume.match') }}",
                       type: 'POST',
                        data: {matchId:  matchId, resumeMatch: usersInfo },
                       dataType: 'json',
                        success: function (data) {
                            window.location.assign("{{ route('matchslist') }}");
                        }
                    });
                }

            });
        });
    </script>
@endsection